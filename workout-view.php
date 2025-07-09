<?php 
    include('include/init.php');
    $programId = $_REQUEST['workoutId']; // switch to $programId
    $workoutId = StartWorkoutFromProgram($programId);

    $sets = GetSetsForWorkout($workoutId);
    $movements = GetMovementsForWorkout($workoutId);

    if(isset($_POST['complete'])){ //fill rows n stuff here
        FinishWorkout($workoutId);
        echo "Workout Finished!
        <br>
        <a href='programs-page.php'>Return</a>
        <br>";
    }
?>
<html>

    <body>
        <form method="post">
        <?php // only displays the workout info rn
        foreach($movements as $m){
            echo $m['movementName']."<br>";
            foreach($sets as $s){
                if ($s['instanceId'] == $m['instanceId'])
                echo "Weight:<input type='number' name='weight' value='". $s['weight'] ."' >
                Reps:<input type='number' name='reps' value='". $s['reps'] ."' >
                <br>";
                
            }
            
        }

        ?>

            <button type="submit" name="complete">Complete Workout!</button>

        </form>
        
    </body>
</html>


