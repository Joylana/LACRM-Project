<?php 
    include("include/init.php");

    if (isset( $_REQUEST['workoutName'])){
        $workoutId = InsertProgram($_REQUEST['workoutName'],$_SESSION["userId"]); // REMINDER: userId is currently hard coded 

        $movements = [];
        $weights = [];

        $movementOrder=0;
        $setOrder=0;
        foreach(array_keys($_REQUEST) as $key){

            
            if (str_contains($key,"movement")){
                $setOrder=0;
                $movementOrder+=1;
                $instanceId = InsertInstance($_REQUEST[$key],$movementOrder,$workoutId); // inserting an instance

            }else if (str_contains($key,"weight")){ //storing current weight for the query
                $weight = $_REQUEST[$key];
            

            }else if (str_contains($key,"reps")){ //incrementing set order and grabbing variables for query
                $setOrder+=1;
                InsertSet($weight,$_REQUEST[$key],$setOrder,$workoutId,$instanceId);

            }
            
        } // writing this out so I can work on explaining myself o7
          // this works because of how the form values are stored. each workout is there then each rep and weight value is underneath in pairs ([weight,reps],[weight,reps])
          // after all sets and reps for that movement there is the variable or the next movement which has all its reps and sets underneath. since it's all in order
          // you can loop thru the list and work with the movement first and move to the weight then to the reps


        header("Location: new-workout.php");
        exit;
    };


?>

<html>
    <head>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <form action="" method="post" id="dynamicForm">
            <h1>New Program:</h1>

            Program Name: <input type="text" name="workoutName" style="height:100px;width:500px;">
            <br>

            <div id="inputContainer">
            </div>

            <button type="button" id="addButton" onclick="NewMovementRow()">Add Movement</button>

            <input type="submit"  >
        </form>

        <div class="sneakytext" id="popUp"> <!-- popup menu to create new movement-->
            <form  action="" method="post"id="popUpForm" >
                <h2>New Movement:</h2>
                <input type="text" name="movementName">
                <select name="movementType" >
                     <option value='push'>Push</option> 
                     <option value='pull'>Pull</option> 
                     <option value='legs'>Legs</option> 
                </select>
                <input type="submit"  >
            </form>
            </div>



    </body>
</html>

<script src="/include/js_functions.js"></script>
<script>

    
  const popupForm = document.getElementById('popUpForm');//submits the form without refreshing the page, also runs InsertNewMovement()
  if (popupForm) {
    popupForm.addEventListener('submit', function(e) {
      e.preventDefault();
      const formData = new FormData(this);
      fetch('movement-submit.php', {
        method: 'POST',
        body: formData
      }).then (data => {HidePopup();})

    }
  )};


    function NewSetRow(id) {// creates a new input row for a set within a specific movement
       var inputContainer = document.getElementById(id);
        var newInputWrapper = document.createElement('div');
        newInputWrapper.classList.add('inputWrapper'); //add styling?????
        var weight = document.createTextNode("Weight:");//weight text
        newInputWrapper.appendChild(weight);

        var newInput = document.createElement('input');//weight field
        newInput.type = 'number';
        newInput.id = 'weightField' + (inputContainer.children.length);
        newInput.name = 'weight'+ (inputContainer.children.length)+ id;
        newInputWrapper.appendChild(newInput);

        var reps = document.createTextNode(" Reps:");//reps text
        newInputWrapper.appendChild(reps);

        var newInput = document.createElement('input');// reps field
        newInput.type = 'number';
        newInput.id = 'repField' + (inputContainer.children.length);
        newInput.name = 'reps'+ (inputContainer.children.length)+ id;
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


    

    function NewMovementRow(){ // adds a new section of movements
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
    }





    
    
</script>

