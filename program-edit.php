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
<script>
    var yes = 1;
    function NewEditMovementRow(movementValue){ // adds a new section of movements
        var inputContainer = document.getElementById('inputContainer');
        var newInputWrapper = document.createElement('div'); //creates a new div for the select element, therefore the elements stack vertically
        newInputWrapper.classList.add('movementWrapper'); //add styling?????
        var id = (inputContainer.children.length);
        newInputWrapper.id = id;

        var select = document.createElement('select'); // creates the select element
        select.setAttribute("onchange", "ShowText(this.value,'popUp')")
        var thisId = "divi" + (inputContainer.children.length); 
        select.id = thisId;
        select.name = "movement" + id;
        select.classList.add('movement-input-box');
        newInputWrapper.appendChild(select); //adds the select element to the created div 

        var removeMovementButton = document.createElement('button');
        removeMovementButton.textContent = '-Remove';
        removeMovementButton.classList.add('remove-button');
        removeMovementButton.addEventListener('click', function() {
            RemoveMovementElement(id)
        });
        removeMovementButton.type = "button";
        newInputWrapper.appendChild(removeMovementButton);

        var newSetButton = document.createElement('button');
        newSetButton.textContent = '+Set';
        newSetButton.addEventListener('click', function() {
            NewSetRow(id)
        });
        newSetButton.type = "button"; // keeps it from submitting the form
        newSetButton.classList.add('add-button');
        newInputWrapper.appendChild(newSetButton); // adds button to wrapper


        inputContainer.appendChild(newInputWrapper); // adds the div to the inputContainer
        
        fetch('endpoint.php', {
            method: 'POST', // Specify the HTTP method as POST
            headers: {
            'Content-Type': 'application/json' // Tell server you're sending JSON
            },
            body: JSON.stringify({value: movementValue}) // Convert the JavaScript object to a JSON string for the request body
            }
            ).then(response =>(
                    response.text()
                )
            ).then(
                data=>(
                    document.getElementById(thisId).innerHTML = data
                )
        )

        return id;

    }

    </script>

<html>
    <body>
        <form method="post">
            <div id='inputContainer'>
<?php 
        echo "<h1> Edit ".$program['workoutName']."</h1>";

        foreach($movements as $m){

            echo "<script> var thisId = NewEditMovementRow(".json_encode($m['movementName'], JSON_UNESCAPED_UNICODE)."); </script>";
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
