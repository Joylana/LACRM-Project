<?php 
    include('include/init.php');
    $programid = $_REQUEST['workoutId']; // switch to $programId
    $workoutId = StartWorkoutFromProgram($programid);
    $sets = GetSetsForWorkout($workoutId);
    $movements = GetMovementsForWorkout($workoutId);

    if(isset($_POST['complete'])){
        FinishWorkout($workoutId);
    }
?>
<html>

    <body>
        <?php // only displays the workout info rn
        foreach($movements as $m){
            echo $m['movementName']."<br>";
            foreach($sets as $s){
                if ($s['movementId'] == $m['movementId'])
                echo "weight: ". $s['weight'] ." Reps: ". $s['reps'] ."<br>";
            }
            
        }
        ?>

        <form method="post">
            <button type="submit" name="complete">Complete Workout!</button>
        </form>
        
        
    </body>
</html>


