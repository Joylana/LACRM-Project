<?php 
    include('include/init.php');

    $programs = GetPrograms($_SESSION["userId"]);
?>

<html>
    <body>

        <a href='new-program.php'>New Program</a>

        <?php //displaying saved programs
        foreach ($programs as $p){
            echo " <a href='program-view.php?workoutId=". $p['workoutId'] ."'>". $p['workoutName'] ."</a> ";
        }
        ?>
    </body>
</html>