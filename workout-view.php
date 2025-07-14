<?php 
    include('include/init.php');
    $programId = $_REQUEST['workoutId']; // switch to $programId

    $program = GetProgram($programId,$_SESSION['userId']);

    $sets = GetSetsForWorkout($programId); //pulling from the original program
    $movements = GetMovementsForWorkout($programId);

    if(isset($_POST['complete'])){ //fill rows n stuff here

        $workoutId = $_REQUEST['newWorkoutId'];
        FinishWorkout($workoutId);
        echo "Workout Finished!
        <br>
        <a href='programs-page.php'>Return</a>
        <br>";

        AddRepsAndSets($workoutId);
        
    }else{

        $newWorkoutId = StartWorkoutFromProgram($programId);

    }
?>
<html>

    <body>
        
        <form method="post">
        <?php // only displays the workout info rn

        echo "<h2>".$program['workoutName']."</h2>";

        $nameNum = 0;
        foreach($movements as $m){
            echo $m['movementName']."<br>";
            $movementName ='movement'.$nameNum;
            echo "<input type='hidden' name='".$movementName."' value='". $m['movementId'] ."' >";
            foreach($sets as $s){
                
                if ($s['instanceId'] == $m['instanceId']){ //change names for inputs

                    $weightName = 'weight'.$nameNum;
                    $repName ='reps'.$nameNum;

                    echo "Weight:<input type='number' name='".$weightName."' value='". $s['weight'] ."' >
                    Reps:<input type='number' name='".$repName."' value='". $s['reps'] ."' >
                    <br>";

                    $nameNum +=1;
                }
                
            }
            
        }
        if(!isset($_POST['complete'])){
            echo "<input type='hidden' name='newWorkoutId' value='".$newWorkoutId."'/>";
        }

        ?>

            <button type="submit" name="complete">Complete Workout!</button>

        </form>
        
    </body>
</html>


