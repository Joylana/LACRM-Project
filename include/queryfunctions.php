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
    }