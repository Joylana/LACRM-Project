<?php 
    include('include/init.php');
    $programId = $_REQUEST['workoutId'];
    $program = GetProgram($programId,$_SESSION['userId']);
       
    $movements = GetMovementsForWorkout($programId);
    $sets = GetSetsForWorkout($programId);

    if(isset($_POST['complete'])){

        foreach(array_keys($_REQUEST) as $key){ //inserting the same as in new workout

            
            if (str_contains($key,"weight")){ //storing current weight for the query
    
                $weight = $_REQUEST[$key];
            
            }else if (str_contains($key,"reps")){ //incrementing set order and grabbing variables for query

                UpdateSet($weight,$_REQUEST[$key],$setId);

            }else{
                $setId = $_REQUEST[$key];
            }
            
        }
        header('Location: program-view.php?workoutId='.$programId);
        exit;
    }
    ?>
<html>
    <body>
        <form method="post">
        <?php 
        echo "<h2> Edit ".$program['workoutName']."</h2>";

        $nameNum = 0;
        foreach($movements as $m){
            echo $m['movementName']."<br>";
            $movementName ='movement'.$nameNum;
            foreach($sets as $s){
                
                if ($s['instanceId'] == $m['instanceId']){ //change names for inputs

                    $weightName = 'weight'.$nameNum;
                    $repName ='reps'.$nameNum;

                    echo "<input type='hidden' name='".$s['setId']."' value='". $s['setId'] ."' >";

                    echo "Weight:<input type='number' name='".$weightName."' value='". $s['weight'] ."' >
                    Reps:<input type='number' name='".$repName."' value='". $s['reps'] ."' >
                    <br>";

                    $nameNum +=1;
                }
                
            }
            
        }

        ?>

            <button type="submit" name="complete">Save</button>

        </form>
        
    </body>
</html>
