<?php 
    include('include/init.php');

    $programs = GetPrograms($userId);
?>

<html>
    <body>

        <?php //displaying saved programs
        foreach ($programs as $p){
            echo " <a href='program-view.php?workoutId=". $p['workoutId'] ."'>". $p['workoutName'] ."</a> ";
        }
        ?>
    </body>
</html>