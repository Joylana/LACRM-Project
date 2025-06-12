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

    //movement functions
    function GetMovementsForWorkout($workoutId){
        // $movements = dbQuery("
        // SELECT movementId FROM sets
        // WHERE workoutId = ". $workoutId."
        // ")->fetchAll();
        $movements = dbQuery("
        SELECT * FROM movements
        WHERE workoutId = ". $workoutId ."
        ")->fetchAll();
        return $movements;

    }

    //set functions
    function GetSetsForWorkout($workoutId){
        $sets = dbQuery("
            SELECT * FROM sets
            WHERE workoutId = ".$workoutId."
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

    function GenreateId(){// take the current hour,minute, and second then add a random number to return an id. (I feel like i ate with this one or the bar is in hell)
        $id = date("his"); // each id is 6 digits long
        $add = rand(100000,889999);
        $id = $id +$add;

        return $id;
    }

    function InsertProgram($name,$userId){// creates a new program
        $workoutId = GenreateId();
        dbQuery("INSERT INTO workouts(workoutId,workoutName, isProgram, userId) 
        VALUES (".$workoutId.",'".$name."',1,".$userId.")
        ");
        return $workoutId;
    };

    function InsertMovement($movementName,$movementType,$workoutId=NULL){//should this be NewMovement()?
        $movementId = GenreateId();
        dbQuery("
        INSERT INTO movements(movementId, movementName, movementType, workoutId)
        VALUES (".$movementId.",'".$movementName."', '".$movementType."', ".$workoutId.")
        ");
        return $movementId;
        
    };

    function InsertSet($weight,$reps,$workoutId,$movementId){
        $setId = GenreateId();
        dbQuery("
            INSERT INTO sets(setId,weight,reps,workoutId,movementId)
            VALUES(".$setId.",".$weight.",".$reps.",".$workoutId.",".$movementId.")
        ");
        return $setId;

    };

    