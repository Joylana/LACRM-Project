<?php

    function GetUsers(){
        $users = dbQuery("
            SELECT * FROM users
        ")->fetchAll();
        return $users;
    };

    function GetUser($userId){
        $user = dbQuery("
            SELECT * FROM users
            WHERE userId = :userId
        ",
        ['userId' => $userId]
        )->fetch();
        return $user;
    };

    function VerifyUser($username,$password){
        $user = dbQuery("
            SELECT userId, password FROM users
            WHERE username = '".$username."'
        ")->fetch();

        if(password_verify($password,$user['password'])){
            return $user['userId'];
        }else{
            return FALSE;
        }
    }

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
        $program = dbQuery("
            SELECT * FROM workouts
            WHERE isProgram = 1 AND
            userId = :userId AND
            workoutId = :programId
        ",
        ['programId'=>$programId,
        'userId' => $userId
        ])->fetch();
        return $program;
    }

    // Workout Functions
    function GetWorkouts($userId){
        $workouts = dbQuery("
            SELECT * FROM workouts
            WHERE isProgram IS NULL AND
            userId = ".$userId."
            ORDER BY dateTimeStarted DESC
        ")->fetchAll();
        return $workouts; 
    }

    function GetWorkout($workoutId){
        $workout = dbQuery("
            SELECT * FROM workouts
            WHERE workoutId = :workoutId"
        ,
        ['workoutId'=>$workoutId]
        )->fetch();
        return $workout;
    }

    function FinishWorkout($workoutId){
        $end = date("Y-m-d H:i:s");
        dbQuery("
        UPDATE workouts
        SET dateTimeEnded = '".$end."'
        WHERE workoutId = ".$workoutId." 
        ");
    }

    //movement functions

    function GetAllMovements(){
        $movements = dbQuery("
            SELECT * FROM movements WHERE 1
        ")->fetchAll();
        return $movements; 
    }

    function MovementDropdown($selected = NULL){
        $movements = GetAllMovements();

        foreach($movements as $movement){
            if($selected == $movement['movementName']){
                echo " <option value='".$movement['movementId']."' selected='".$movement['movementName']."'>".$movement['movementName']."</option> ";

            } else{
                echo " <option value='".$movement['movementId']."' >".$movement['movementName']."</option> ";
            }
        }
        echo " <option value='new'>New Movement</option> ";
    }

    function GetMovementsForWorkout($workoutId){// adding join to pull movementInstances and movements together
        $movements = dbQuery("
        SELECT * FROM movementInstances INNER JOIN movements ON movementInstances.movementId = movements.movementId
        WHERE workoutId = ". $workoutId ."
        ORDER BY movementOrder
        ")->fetchAll();
        return $movements;
    }

    function GetAllInstances($userId){ // highkey over kill on rows rn
        $instances = dbQuery("
        SELECT * FROM movementInstances INNER JOIN sets 
        ON movementInstances.instanceId = sets.instanceId
        INNER JOIN workouts 
        ON sets.workoutId = workouts.workoutId
        WHERE isProgram IS NULL AND userId = ".$userId."
        ORDER BY dateTimeStarted DESC
        ")->fetchAll();
        return $instances;
    }

    //volume functions


    function GetVolume($userId){ //did stuff in the for loop and it worked, very scared to touch it now :,)
        $instances = dbQuery("
        SELECT movementInstances.instanceId,movementId, reps, weight, dateTimeStarted
        FROM movementInstances INNER JOIN sets 
        ON movementInstances.instanceId = sets.instanceId
        INNER JOIN workouts 
        ON sets.workoutId = workouts.workoutId
        WHERE isProgram IS NULL AND userId = ".$userId."
        ORDER BY movementId, dateTimeStarted 
        ")->fetchAll(); //isComplete needs to be taken into account later and userId should be specified



        $volumes = [];
        $volumeSum = 0;
        $date = NULL; // date is initialized to null
        $movementId = NULL;
        foreach($instances as $i){ // organized by movement id as well as ordered by date (damn...)
            
            if($date == $i['dateTimeStarted'] ){ // adding to the volume
                $volumeSum +=($i['reps'] * $i['weight']);
                $movementId = $i['movementId'];
                
            }else if($date == NULL){
                $movementId = $i['movementId'];
                $date = $i['dateTimeStarted'];

                $volumeSum = $i['reps'] * $i['weight'];
            }else{ // if id's don't match it will move on to the next id and start recalculating volume
                $volumes[] = array("y" => $volumeSum, "label" => $date, 'movementId'=> $movementId); //ignore that squiggly line (trust me)
                //$volume[$id] = $vol;
                $date = $i['dateTimeStarted'];
                $volumeSum = $i['reps'] * $i['weight'];
                $movementId = $i['movementId'];
                
            }
        }
        if(isset($movementId)){
            $volumes[] = array("y" => $volumeSum, "label" => $date, 'movementId'=> $movementId);
        }


        return $volumes;

    }

    function SeperateVolumes($movementId,$volumeData){ //seperates volumes by workout and returns an array of only those volumes

        $graphArray = [];
    

        foreach($volumeData as $v){
            if( $v['movementId'] == $movementId ){ // loops thru and adds data point of they match the given id
                $graphArray[] = $v;
            }
        }
        return $graphArray;

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

    function GetSetsAndMovementsForWorkout($workoutId){ // gets all movement, set, and instance info for each set
        $movementsAndSets = dbQuery("
        SELECT * FROM movementInstances INNER JOIN movements 
        ON movementInstances.movementId = movements.movementId
        INNER JOIN sets 
        ON movementInstances.instanceId = sets.instanceId
        WHERE movementInstances.workoutId = :workoutId
        ORDER BY movementOrder, setOrder
        ",
        ['workoutId'=>$workoutId])->fetchAll();
        return $movementsAndSets;

    }

    function FinishSet($setId){
        dbQuery("
        UPDATE sets
        SET isComplete = 1
        WHERE setId = ".$setId." 
        ");
    }

    // NOTE: a baddie just left the baddie factory

    function GenerateId(){// take the current hour, minute, and second then add a random number to return an id. (I feel like i ate with this one or the bar is in hell)
        $id = date("his"); // each id is 6 digits long
        $add = rand(100000,889999);
        $id = $id +$add;

        return $id;
    }

    // measurement functions

    function GetLatestMeasurement($bodyPartId,$userId){

        $latestEntry = dbQuery("
        SELECT size
        FROM measurements
        WHERE bodyPartId= :bodyPartId AND userId = :userId
        ORDER BY dateLogged DESC
        LIMIT 1;
        ",
        ['bodyPartId'=>$bodyPartId,
        'userId'=>$userId]
        )->fetch();

        return $latestEntry;
    }

    function GetAllMeasurements($bodyPartId,$userId){

        $measurements = dbQuery("
        SELECT * FROM measurements
        WHERE bodyPartId= :bodyPartId AND userId = :userId
        ORDER BY dateLogged DESC
        ",
        ['bodyPartId'=>$bodyPartId,
        'userId'=>$userId]
        )->fetchAll();

        return $measurements;
    }

    // Inserting functions and creating new workouts and programs

    function InsertProgram($name,$userId){// creates a new program
        $workoutId = GenerateId();
        dbQuery("INSERT INTO workouts(workoutId,workoutName, isProgram, userId) 
        VALUES (".$workoutId.",'".$name."',1,".$userId.")
        ");
        return $workoutId;
    };

    function InsertWorkoutsRow($name,$userId){// creates a new program
        $workoutId = GenerateId();
        $start = date("Y-m-d H:i:s"); //dateTimeStarted
        dbQuery("INSERT INTO workouts(workoutId, dateTimeStarted, workoutName, userId) 
        VALUES (:workoutId, :start, :name, :userId)
        ",
        ['workoutId'=>$workoutId,
        'start'=>$start,
        'name'=>$name,
        'userId'=>$userId
        ]);
        return $workoutId;
    };



    function InsertNewMovement($movementName,$movementType){// creates a new movement (new row in the movements table)
        $movementId = GenerateId();
        dbQuery("
            INSERT INTO movements(movementId,movementName,movementType)
            VALUES (".$movementId.",'".$movementName."','".$movementType."')
        ");
        return $movementId;
    }
    
    function InsertInstance($movementId,$movementOrder,$workoutId){// creates a new instance of an existing movement
        $instanceId = GenerateId();
        dbQuery("
            INSERT INTO movementInstances(instanceId,movementOrder,movementId, workoutId)
            VALUES (".$instanceId.",".$movementOrder.",".$movementId.", ".$workoutId.")
        ");
        return $instanceId;
    };

    function UpdateSet($weight,$reps,$setId){ // updates the weight and reps of an instance
        dbQuery("
        UPDATE sets
        SET weight = ".$weight.", reps = ".$reps."
        WHERE setId = ".$setId." 
        ");

    };

    function InsertSet($weight,$reps,$setOrder,$workoutId,$instanceId){
        $setId = GenerateId();
        dbQuery("
            INSERT INTO sets(setId,weight,reps,setOrder,workoutId,instanceId)
            VALUES(".$setId.",".$weight.",".$reps.",".$setOrder.",".$workoutId.",".$instanceId.")
        ");
        return $setId;
    };


    function StartWorkoutFromProgram($workoutId){  // takes a program and duplicates all of the data: workout info, movements, sets

        //create a new row in workouts
        $newWorkoutId = GenerateId();
        $start = date("Y-m-d H:i:s"); //dateTimeStarted
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

        return $newWorkoutId;

    };

    function AddRepsAndSets($workoutId){
        $weight = NULL; //getting the squiggly lines to go away :)
        $add = NULL;
        $movementId = NULL;
        $instanceId = NULL;
            
        $movementOrder = 0;
        $setOrder = 0;

        foreach(array_keys($_REQUEST) as $key){ //inserting the same as in new workout
            
            if (str_contains($key,"movement")){

                $setOrder = 0;
                $movementId = $_REQUEST[$key]; // inserting an instance
                $add = True;

            }else if (str_contains($key,"weight")){ //storing current weight for the query

                $weight = $_REQUEST[$key];

                if($add == True){
                    $movementOrder += 1; // only creating an instance if there is actualu some weight following it (so if it's empty no instance is made)
                    $instanceId = InsertInstance($movementId,$movementOrder,$workoutId);
                }
            

            }else if (str_contains($key,"reps")){ //incrementing set order and grabbing variables for query
                $setOrder += 1;
                InsertSet($weight,$_REQUEST[$key],$setOrder,$workoutId,$instanceId);
                $add = False;

            }
            
        }
         // writing this out so I can work on explaining myself o7
          // this works because of how the form values are stored. each workout is there then each rep and weight value is underneath in pairs ([weight,reps],[weight,reps])
          // after all sets and reps for that movement there is the variable or the next movement which has all its reps and sets underneath. since it's all in order
          // you can loop thru the list and work with the movement first and move to the weight then to the reps

    }

    function CreateNewUser($userFn, $userLn, $username, $password, $goal, $weight){

        $date = date("Y-m-d");
        $userId = GenerateId();

        if(empty($goal)){
            $goal = NULL;
        }
        if(empty($weight)){
            $weight = NULL;
        }

        dbQuery('
            INSERT INTO users
            (userId, userName, userFirstName, userLastName, weight, goal, startDate, password)
            VALUES (:userId, :userName, :userFirstName, :userLastName, :weight, :goal, :startDate, :password)
            ',
            ['userId' => $userId,
            'userName' => $username,
            'userFirstName' => $userFn,
            'userLastName' => $userLn,
            'weight' => $weight,
            'goal' => $goal,
            'startDate' => $date,
            'password' => $password
            ]
            );

        return $userId;
    }

    function NewMeasurement($bodyPartId,$measurement,$userId){
        $date = date("Y-m-d");
        $measurementId = GenerateId();

        dbQuery("
        INSERT INTO measurements
        (measurementId, size, dateLogged, userId, bodyPartId)
        VALUES (:measurementId, :measurement, :date, :userId, :bodyPartId)
        ",
        ['measurementId'=>$measurementId,
        'bodyPartId'=>$bodyPartId,
        'measurement'=>$measurement,
        'date'=>$date,
        'userId'=>$userId]
        );
    }

    function ProcessMeasurements($measurements){

        $measurementArray = [];

        foreach($measurements as $m){
            $measurementArray[] = array("y" => $m['size'], "label" => $m['dateLogged']);
        }
        return $measurementArray;
    }

    //deleting functions (omg)

    function DeleteSetAndInstance($instanceId){ //deleting both the set and movementInstance together
        dbQuery("
        DELETE FROM sets WHERE
        instanceId = ".$instanceId."
        ");

        dbQuery("
        DELETE FROM movementInstances WHERE
        instanceId = ".$instanceId."
        ");

    }

    