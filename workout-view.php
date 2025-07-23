<?php 
    include('include/init.php');
    if(!isset($_REQUEST['workoutId'])){
        echo "No workout found. Please select an existing program <br>";
        echo "<a href='programs-page.php'>Return to Programs Page</a>";
        exit;
    }

    NavBar();

    $programId = $_REQUEST['workoutId']; 
    $program = GetProgram($programId,$_SESSION['userId']);

    $sets = GetSetsForWorkout($programId); //pulling from the original program
    $movements = GetMovementsForWorkout($programId);

    if(isset($_POST['complete'])){ //fill rows n stuff here

        $workoutId = $_REQUEST['newWorkoutId'];
        FinishWorkout($workoutId);
        echo "<h1> Workout Finished! </h1>
        <br>
        <a style='font-size:30px' href='programs-page.php'>Return</a>
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

        echo "
        <h1>".$program['workoutName']."</h1>";
        echo "<div>".date("h:i:s")."</div>";

        echo

        $nameNum = 0;
        foreach($movements as $m){
            echo "<div class='movement-input-box'>". $m['movementName']."</div><br>";
            $movementName ='movement'.$nameNum;
            echo "<input type='hidden' name='".$movementName."' value='". $m['movementId'] ."' >";
            foreach($sets as $s){
                
                if ($s['instanceId'] == $m['instanceId']){ //change names for inputs

                    $weightName = 'weight'.$nameNum;
                    $repName ='reps'.$nameNum;

                    echo "
                    <div class='setWrapper'>
                    Weight:<input class='workout-input-box' type='number' name='".$weightName."' value='". $s['weight'] ."' >
                    <span class='repWrapper' style='margin-right:75px'>
                    Reps:<input class='workout-input-box' type='number' name='".$repName."' value='". $s['reps'] ."' >
                    </span>
                    </div>
                    <br>";

                    $nameNum +=1;
                }
                
            }
            
        }
        if(!isset($_POST['complete'])){
            echo "<input type='hidden' name='newWorkoutId' value='".$newWorkoutId."'/>";
        }

        ?>

            <button style='margin-left:28px' class='big-workout-button' type="submit" name="complete">Complete Workout!</button>

        </form>
        
    </body>
</html>


