<?php 
    include('include/init.php');
    $workoutId = $_REQUEST['workoutId']; // switch to $programId
    //$workoutId = StartWorkoutFromProgram($programid);

    $sets = GetSetsForWorkout($workoutId);
    $movements = GetMovementsForWorkout($workoutId);

    if(isset($_POST['complete'])){
        FinishWorkout($workoutId);
        echo "Workout Finished!
        <br>
        <a href='programs-page.php'>Return</a>
        <br>";
    }
?>
<html>

    <body>
        <?php // only displays the workout info rn
        foreach($movements as $m){
            echo $m['movementName']."<br>";
            foreach($sets as $s){
                if ($s['instanceId'] == $m['instanceId'])
                echo "weight: ". $s['weight'] ." Reps: ". $s['reps'] ."<br>";
            }
            
        }

        ?>

        <form method="post">
            <button type="submit" name="complete">Complete Workout!</button>
        </form>

        
    </body>
</html>


