<?php 
    include('include/init.php');
    $workoutId = $_REQUEST['workoutId'];
       
    $movements = GetMovementsForWorkout($workoutId);
    $sets = GetSetsForWorkout($workoutId);


    echo " <a href='workout-view.php?workoutId=". $workoutId ."'> Start Workout </a> ";

    echo '<br>sets:';
    debugOutput($sets);
    echo '<br>movements for workout:';
    debugOutput($movements);
?>

