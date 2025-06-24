<?php 
    include('include/init.php');
    $workoutId = $_REQUEST['workoutId'];
       
    $movements = GetMovementsForWorkout($workoutId);
    $sets = GetSetsForWorkout($workoutId);

    echo " <a href='workout-view.php?workoutId=". $workoutId ."'> Start Workout </a> ";

    foreach($movements as $m){//displaying current program info
        echo "<br>".$m['movementName']."<br>";
        foreach($sets as $s){
            if ($s['instanceId'] == $m['instanceId'])
            echo "weight: ". $s['weight'] ." Reps: ". $s['reps'] ."<br>";
        }
    
    }

?>

