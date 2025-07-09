<?php 
    include("include/init.php");

    if (isset( $_REQUEST['workoutName'])){
        $workoutId = InsertProgram($_REQUEST['workoutName'],$_SESSION["userId"]); // REMINDER: userId is currently hard coded 

        // $movements = [];
        // $weights = [];

        AddRepsAndSets($workoutId);
        
        header("Location: programs-page.php");
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
      }).then (data => {popupForm.classList.remove('surprisetext');
                        popupForm.classList.add('sneakytext');})

    }
  )};






    
    
</script>

