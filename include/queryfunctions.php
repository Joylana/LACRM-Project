<?php

    function GetUsers(){
        $users = dbQuery("
            SELECT * FROM users
        ")->fetchAll();
        return $users;
    };

    // Program Functions
    function GetPrograms($userId){
        $programs = dbQuery("
            SELECT * FROM workouts
            WHERE isProgram = 1 AND
            userId = ".$userId."
        ")->fetchAll();
        return $programs; 
    }

    function GetProgram($programId,$userId){
        $program = GetPrograms($userId);
        return $program[$programId];
    }

    // Workout Functions
    function GetWorkouts($userId){
        $workouts = dbQuery("
            SELECT * FROM workouts
            WHERE isProgram IS NULL AND
            userId = ".$userId."
        ")->fetchAll();
        return $workouts; 
    }

    function GetWorkout($workoutId,$userId){
        $workout = GetWorkouts($userId);
        return $program[$workoutId];
    }

    function FinishWorkout($workoutId){
        $end = date("Y-m-d h:i:s");
        dbQuery("
        UPDATE workouts
        SET dateTimeEnded = '".$end."'
        WHERE workoutId = ".$workoutId." 
        ");
    }

    //movement functions
    function GetMovementsForWorkout($workoutId){
        $movements = dbQuery("
        SELECT * FROM movements
        WHERE workoutId = ". $workoutId ."
        ORDER BY movementOrder
        ")->fetchAll();
        return $movements;
    }

    //set functions
    function GetSetsForWorkout($workoutId){
        $sets = dbQuery("
            SELECT * FROM sets
            WHERE workoutId = ".$workoutId."
            ORDER BY setOrder
        ")->fetchAll();
        return $sets;
    };

    function FinishSet($setId){
        dbQuery("
        UPDATE sets
        SET isComplete = 1
        WHERE setId = ".$setId." 
        ");
    }

    //Inserting new workout, movement, and set

    // NOTE: a baddie just left the baddie factory

    function GenerateId(){// take the current hour, minute, and second then add a random number to return an id. (I feel like i ate with this one or the bar is in hell)
        $id = date("his"); // each id is 6 digits long
        $add = rand(100000,889999);
        $id = $id +$add;

        return $id;
    }

    function InsertProgram($name,$userId){// creates a new program
        $workoutId = GenerateId();
        dbQuery("INSERT INTO workouts(workoutId,workoutName, isProgram, userId) 
        VALUES (".$workoutId.",'".$name."',1,".$userId.")
        ");
        return $workoutId;
    };

    function InsertMovement($movementName,$movementType,$movementOrder,$workoutId=NULL){
        $movementId = GenerateId();
        dbQuery("
        INSERT INTO movements(movementId, movementName, movementType,movementOrder, workoutId)
        VALUES (".$movementId.",'".$movementName."', '".$movementType."',".$movementOrder.", ".$workoutId.")
        ");
        return $movementId;
    };

    function InsertSet($weight,$reps,$setOrder,$workoutId,$movementId){
        $setId = GenerateId();
        dbQuery("
            INSERT INTO sets(setId,weight,reps,setOrder,workoutId,movementId)
            VALUES(".$setId.",".$weight.",".$reps.",".$setOrder.",".$workoutId.",".$movementId.")
        ");
        return $setId;
    };


    function StartWorkoutFromProgram($workoutId){  // takes a program and duplicates all of the data: workout info, movements, sets

        //create a new row in workouts
        $newWorkoutId = GenerateId();
        $start = date("Y-m-d h:i:s"); //dateTimeStarted
        dbQuery("
        INSERT INTO workouts
            (workoutId, workoutName, dateTimeStarted, isProgram, userId) 
        SELECT 
            ".$newWorkoutId.",workoutName, '". $start ."', NULL, userId
        FROM 
            workouts
        WHERE 
            workoutId = ".$workoutId."
        ");

        $movements = GetMovementsForWorkout($workoutId);
        $sets = GetSetsForWorkout($workoutId);

        $movementIds = [];
        $setIds = [];

        foreach($movements as $m){// returns the id's of movements
            $movementIds[] = $m['movementId'];
        }

        foreach($sets as $s){// returns the id's of sets
            $setIds[] = $s['setId'];
        }
        //loop thru and insert new rows for each table
        foreach($movementIds as $movementId){//movements
            $newMovementId = GenerateId();
            dbQuery("
                INSERT INTO movements
                    (movementId, movementName, movementType,movementOrder, workoutId)
                SELECT 
                    ".$newMovementId.", movementName, movementType, movementOrder, ".$newWorkoutId."
                FROM 
                    movements
                WHERE 
                    movementId = ".$movementId."
            ");

            foreach($setIds as $setId){//sets only adding if the id's match
                $newSetId = GenerateId();
                dbQuery("
                    INSERT INTO sets
                        (setId,weight,reps,setOrder,workoutId,movementId)
                    SELECT 
                        ".$newSetId.",weight,reps,setOrder,".$newWorkoutId.", ".$newMovementId."
                    FROM 
                        sets
                    WHERE 
                        setId = ".$setId."
                        AND
                        movementId = ".$movementId."
                ");
            }
        }
        return $newWorkoutId;
    };
    