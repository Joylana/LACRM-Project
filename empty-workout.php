<?php 

    include("include/init.php");
    NavBar();

    if (isset( $_REQUEST['workoutName'])){
        $workoutId = InsertWorkoutsRow($_REQUEST['workoutName'],$_SESSION["userId"]);

        AddRepsAndSets($workoutId);
        
        FinishWorkout($workoutId);
        echo "<h1> Workout Finished! </h1>
        <br>
        <a style='font-size:30px' href='programs-page.php'>Return</a>
        <br>";
        exit;
    };


?>
<head>
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
</head>
  
    <h1>New Workout</h1>

    <form action="" method="post" id="dynamicForm" style="margin:20px">

      <?php echo "<div style='font-size:40px'>".date("h:i:s")."</div>"; ?>
      <label class="program-name" for="workoutName"> Workout Name: </label>
      <br>
      <input type="text" name="workoutName" id="workoutName" class="text-box" style="height:100px;width:100%;text-align: left;">
      <br>

      <div id="inputContainer">
      </div>

      <button type="button" id="addButton" class='workout-button' onclick="NewMovementRow()">Add Movement</button>

      <div style="text-align: center;margin-top:10px">
        <input class='big-workout-button' type="submit" value="Finish Workout" >
      </div>
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


</div>



</body>
</html>

