<?php
    include('include/init.php');


    $workoutHistory = GetWorkouts($_SESSION['userId']);

    NavBar();

    echo "<h1>Workout History</h1>";

    foreach($workoutHistory as $workout){
        echo "<div class='program-name'>".$workout['workoutName']."</div>
        <br>
        <div class='movementWrapper' style='margin:20px'>
        ";
        if(isset($workout['dateTimeEnded'])){
            echo substr($workout['dateTimeEnded'],0,-9)."<br>";
        }

        $workoutSets = GetSetsAndMovementsForWorkout($workout['workoutId']);

        $currentMovementName = NULL;

        foreach($workoutSets as $sets){
            if($currentMovementName == NULL || $currentMovementName != $sets['movementName']){
                if ($currentMovementName != NULL){
                    echo "<hr style='width:60%;text-align:center;'>";
                }
                $currentMovementName = $sets['movementName'];
                echo "
                <div class='program-name'>".$currentMovementName."</div><br>";
            }
           echo "<div style='text-align:center' class='set-display'>Weight: ".$sets['weight']." Reps: ".$sets['reps']."</div><br>";
        }
        echo "
        </div>";

    }
?>