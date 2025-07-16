<?php
    include('include/init.php');


    $workoutHistory = GetWorkouts($_SESSION['userId']);


    foreach($workoutHistory as $workout){
        echo "<b>".$workout['workoutName']."</b><br>";
        echo $workout['dateTimeEnded']."<br>";

        $workoutSets = GetSetsAndMovementsForWorkout($workout['workoutId']);
        //debugOutput($workoutSets);
        $currentMovementName = NULL;

        foreach($workoutSets as $sets){
            if($currentMovementName == NULL || $currentMovementName != $sets['movementName']){
                $currentMovementName = $sets['movementName'];
                echo $currentMovementName."<br>";
            }
           echo "Weight: ".$sets['weight']." Reps: ".$sets['reps']."<br>";
        }
        echo "<br>";

    }
?>