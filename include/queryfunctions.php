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
        $workout = GetPrograms($userId);
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

    function GetMovementsForSet($workoutId){ //we need this one?


    }

    //set functions
    function GetSetsForWorkout($workoutId){
        $sets = dbQuery("
            SELECT * FROM sets
            WHERE workoutId = ".$workoutId."
        ")->fetchAll();
        return $sets;
    };

    //Inserting new workout, movement, and set

    // NOTE: ALL functions below have id's hard coded... gotta fix that

    function InsertProgram($workoutId,$name,$userId){// creates a new EMPTY program and returns the id of said program
        dbQuery("INSERT INTO workouts(workoutId,workoutName, isProgram, userId) 
        VALUES (".$workoutId.",'".$name."',1,".$userId.")
        ");
        //return $workoutId;
    };
    function InsertMovement($movementId,$movementName,$movementType,$workoutId){
        dbQuery("
        INSERT INTO movements(movementId, movementName, movementType, workoutId)
        VALUES (".$movementId.",'".$movementName."', '".$movementType."', ".$workoutId.")
        ");
        //return $movementId;
        
    };
    function InsertSet($weight,$reps,$workoutId,$movementId){
        dbQuery("
            INSERT INTO sets(weight,reps,workoutId,movementId)
            VALUES(".$weight.",".$reps.",".$workoutId.",".$movementId.")
        ");

    };

    