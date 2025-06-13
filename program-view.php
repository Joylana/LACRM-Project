<?php 
    include('include/init.php');
    $workoutid = $_REQUEST['workoutid'];
       
    $movements = GetMovementsForWorkout($workoutid);
    $sets = GetSetsForWorkout($workoutid);

    echo 'sets:';
    debugOutput($sets);
    echo '<br>movements for workout:';
    debugOutput($movements);
?>

