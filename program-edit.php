<?php 
    include('include/init.php');
    $programId = $_REQUEST['workoutId'];
    $program = GetProgram($_REQUEST['workoutId'],$_SESSION['userId']);
       
    $movements = GetMovementsForWorkout($programId);
    $sets = GetSetsForWorkout($programId);

    NavBar(1);

    if(isset($_POST['complete'])){

        $movementOrder=0;
        $setOrder=0;
        foreach(array_keys($_REQUEST) as $key){ //inserting the same as in new workout

            
            if (str_contains($key,"movement")){
                //echo "movement";
                $setOrder=0;
                $movementId = $_REQUEST[$key]; // inserting an instance
                $add = True;

            }else if (str_contains($key,"weight")){ //storing current weight for the query
                //echo "weight";
                $weight = $_REQUEST[$key];
                if($add==True){
                    $movementOrder+=1; // only creating an instance if there is actualu some weight following it (so if it's empty no instance is made)
                    $instanceId = InsertInstance($movementId,$movementOrder,$programId);
                }
            

            }else if (str_contains($key,"reps")){ //incrementing set order and grabbing variables for query
                $setOrder+=1;
                InsertSet($weight,$_REQUEST[$key],$setOrder,$programId,$instanceId); //ignore the squigglys
                $add=False;

            }else if (!str_contains($key,"workout") and !str_contains($key,"complete")){
                DeleteSetAndInstance($_REQUEST[$key]); //DELETE IIIIIIT

            }
            
        }

        header('Location: program-view.php?workoutId='.$programId);
        exit;
    }
?>
<script src="/include/js_functions.js"></script>


<html>
    <body>
        <form method="post">
            <div id='inputContainer'>
<?php 
        echo "<h1> Edit ".$program['workoutName']."</h1>";

        foreach($movements as $m){

            echo "<script> var thisId = NewMovementRow(".json_encode($m['movementName'], JSON_UNESCAPED_UNICODE)."); </script>";
            echo '<input type="hidden" value="'.$m['instanceId'].'" name="'.$m['instanceId'].'"/>';

            foreach($sets as $s){
                
                if ($s['instanceId'] == $m['instanceId']){ //change names for inputs

                    echo "<script> NewSetRow(thisId,".json_encode($s['weight']).",".json_encode($s['reps'])."); </script>";

                }
                
            }
            
        }

        ?>
        </div>
        <button class='workout-button' type="button" id="addButton" onclick="NewMovementRow()">Add Movement</button>
        <button class='big-workout-button' type="submit" name="complete">Save</button>

        </form>

    <div class="sneakytext" id="popUp"> <!-- popup menu to create new movement-->
      <form  action="" method="post"id="popUpForm" >
          <h2>New Movement:</h2>
          <input style='font-size:40px;width:250px' type="text" name="movementName">
          <select style='font-size:30px' class='movement-input-box' name="movementType" >

              <option value='push'>Push</option> 
              <option value='pull'>Pull</option> 
              <option value='legs'>Legs</option> 

          </select>
          <input class='workout-button' type="submit"  >
      </form>
      </div>
        
    </body>

</html>
