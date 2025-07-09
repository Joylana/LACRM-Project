<?php 
    include('include/init.php');
    $programId = $_REQUEST['workoutId']; // switch to $programId
    $workoutId = StartWorkoutFromProgram($programId);

    $sets = GetSetsForWorkout($programId); //pulling from the original program
    $movements = GetMovementsForWorkout($programId);
    debugOutput($_REQUEST);

    if(isset($_POST['complete'])){ //fill rows n stuff here
        FinishWorkout($workoutId);
        echo "Workout Finished!
        <br>
        <a href='programs-page.php'>Return</a>
        <br>";

        $movementOrder=0;
        $setOrder=0;
        foreach(array_keys($_REQUEST) as $key){ //inserting the same as in new workout

            
            if (str_contains($key,"movement")){
                //echo "movement";
                $setOrder=0;
                $movementOrder+=1;
                $instanceId = InsertInstance($_REQUEST[$key],$movementOrder,$workoutId); // inserting an instance

            }else if (str_contains($key,"weight")){ //storing current weight for the query
                //echo "weight";
                $weight = $_REQUEST[$key];
            

            }else if (str_contains($key,"reps")){ //incrementing set order and grabbing variables for query
                $setOrder+=1;
                InsertSet($weight,$_REQUEST[$key],$setOrder,$workoutId,$instanceId);
                echo "inserted , ";

            }
            
        }
        
    }
?>
<html>

    <body>
        <form method="post">
        <?php // only displays the workout info rn

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

        ?>

            <button type="submit" name="complete">Complete Workout!</button>

        </form>
        
    </body>
</html>


