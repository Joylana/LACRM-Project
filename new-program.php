<?php 
    include("include/init.php");

    if (isset( $_REQUEST['workoutName'])){
        $workoutId = InsertProgram($_REQUEST['workoutName'],$_SESSION["userId"]); // REMINDER: userId is currently hard coded 

        AddRepsAndSets($workoutId);
        
        header("Location: programs-page.php");
        exit;
    };

    NavBar(1);

?>
<div style='margin: 30px'>
  
    <h1>New Program:</h1>

    <form action="" method="post" id="dynamicForm" style="margin:20px">

      <span class="program-name" > Program Name: </span>
      <br>
      <input type="text" name="workoutName" class="text-box" style="height:100px;width:100%;text-align: left;">
      <br>

      <div id="inputContainer">
      </div>

      <button type="button" id="addButton" class='workout-button' onclick="NewMovementRow()">Add Movement</button>

      <div style="text-align: center;margin-top:10px">
        <input class='big-workout-button' type="submit" value="Save" >
      </div>
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

