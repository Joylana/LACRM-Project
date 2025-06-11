<?php 
    include('include/init.php');
    $movements = GetMovementsForWorkout(2);
    $sets = GetMovementsForSet(2);

    echo 'sets:';
    debugOutput($sets);
    echo '<br>movements for workout:';
    debugOutput($movements);

    $programs = GetPrograms($userId);
?>

<html>
    <body>
        <?php
        foreach ($programs as $p){
            echo " <a href='program-view.php?program=". $p['workoutId'] ."'>". $p['workoutName'] ."</a> ";
        }
        ?>
    </body>
</html>