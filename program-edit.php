<script src="/include/js_functions.js"></script>
<script>
    var yes = 1;
    function NewEditMovementRow(movementValue){ // adds a new section of movements
        var inputContainer = document.getElementById('inputContainer');
        var newInputWrapper = document.createElement('div'); //creates a new div for the select element, therefore the elements stack vertically
        newInputWrapper.classList.add('inputWrapper'); //add styling?????
        var id = (inputContainer.children.length);
        newInputWrapper.id = id;

        var select = document.createElement('select'); // creates the select element
        select.setAttribute("onchange", "ShowText(this.value,'popUp')")
        var thisId = "divi" + (inputContainer.children.length); 
        select.id = thisId;
        select.name = "movement" + id;
        newInputWrapper.appendChild(select); //adds the select element to the created div 

        var newSetButton = document.createElement('button');
        newSetButton.textContent = 'New Set';
        newSetButton.addEventListener('click', function() {
            NewSetRow(id)
        });
        newSetButton.type = "button"; // keeps it from submitting the form
        newInputWrapper.appendChild(newSetButton); // adds button to wrapper

        inputContainer.appendChild(newInputWrapper); // adds the div to the inputContainer
        
        fetch('endpoint.php').then(
                response =>(
                    response.text()
                )
            ).then(
                data=>(
                    document.getElementById(thisId).innerHTML = data
                )
        )
        //select.value = movementValue;
        // document.getElementById(thisId).value = 'Squat';
        // document.getElementById(movementValue).selected = true;
        // console.log(movementValue);

        return id;

    }

    function NewEditSetRow(id,weight,reps) {// creates a new input row for a set within a specific movement
        
        var inputContainer = document.getElementById(id);
        var newInputWrapper = document.createElement('div');
        newInputWrapper.classList.add('inputWrapper'); //add styling?????
        var weight = document.createTextNode("Weight:");//weight text
        newInputWrapper.appendChild(weight);

        var newInput = document.createElement('input');//weight field
        newInput.type = 'number';
        var weightId = 'weightField' + (inputContainer.children.length);
        newInput.id = weightId;
        newInput.name = 'weight'+ (inputContainer.children.length)+ id;
        newInput.value = weight;
        newInputWrapper.appendChild(newInput);

        var reps = document.createTextNode(" Reps:");//reps text
        newInputWrapper.appendChild(reps);

        var newInput = document.createElement('input');// reps field
        newInput.type = 'number';
        var repId = 'repField' + (inputContainer.children.length);
        newInput.id = repId;
        newInput.name = 'reps'+ (inputContainer.children.length)+ id;
        //newInput.value = reps;
        newInputWrapper.appendChild(newInput);

        var newButton = document.createElement('button');
        newButton.textContent = 'Remove';
        //newButton.classList.add('removeButton'); //add styling?????
        newButton.addEventListener('click', function(event) {
            event.preventDefault();
            event.target.parentNode.remove();
        });
        newInputWrapper.appendChild(newButton);


        inputContainer.appendChild(newInputWrapper);

    };
    </script>

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
        //header('Location: program-view.php?workoutId='.$programId);
        //exit;
    }
    ?>
<html>
    <body>
        <form method="post" id='inputContainer'>
        <?php 
        echo "<h2> Edit ".$program['workoutName']."</h2>";

        $nameNum = 0;
        foreach($movements as $m){
            echo $m['movementName']."<br>";
            $movementName ='movement'.$nameNum;

            echo "<script> var thisId = NewEditMovementRow('".json_encode($m['movementName'], JSON_UNESCAPED_UNICODE)."'); </script>";

            foreach($sets as $s){
                
                if ($s['instanceId'] == $m['instanceId']){ //change names for inputs

                    echo "<script> NewEditSetRow(thisId,".json_encode($s['weight']).",".json_encode($s['reps'])."); </script>";

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
    <script>
        console.log(<?php echo json_encode($movements, JSON_UNESCAPED_UNICODE) ?>)


    </script>
</html>
