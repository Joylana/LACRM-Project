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

    function GetWorkout(){
        
    }