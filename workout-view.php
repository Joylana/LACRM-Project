<?php 
    include('include/init.php');
    $workoutId = $_REQUEST['workoutId']; // switch to $programId
    // $workoutId = StartWorkoutFromProgram($programid)
    $sets = GetSetsForWorkout($workoutId);
    $movements = GetMovementsForWorkout($workoutId);
    debugOutput($sets);
    debugOutput($movements);
?>
<html>
    <body>
        <?php
        foreach($movements as $m){
            echo $m['movementName']."<br>";
            foreach($sets as $s){
                if ($s['movementId'] == $m['movementId'])
                echo "weight: ". $s['weight'] ." Reps: ". $s['reps'] ."<br>";
            }
            
        }
        ?>
        
    </body>
</html>