<?php 
    include('include/init.php');
    $programs = GetPrograms($userId);
    $workouts = GetWorkouts($userId);

    echo 'programs:';
    debugOutput($programs);
    echo '<br>workouts:';
    debugOutput($workouts);
?>

<html>
    <body>
        <?php
        foreach ($programs as $p){
            echo " <a href='program-view.php?program=". $p['workoutName'] ."'>". $p['workoutName'] ."</a> ";
        }
        ?>
    </body>
</html>