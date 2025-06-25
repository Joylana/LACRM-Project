<?php 
    include("include/init.php");

    if (isset( $_REQUEST['workoutName'])  && isset($_REQUEST['weight1'])){
        $workoutId = InsertProgram($_REQUEST['workoutName'],$userId); // REMINDER: userId is currently hard coded 
        
        $movementId = InsertInstance($_REQUEST['movements'],1,$workoutId);

        InsertSet($_REQUEST['weight1'],$_REQUEST['reps1'],1,$workoutId,$movementId);
        InsertSet($_REQUEST['weight2'],$_REQUEST['reps2'],2,$workoutId,$movementId);
        InsertSet($_REQUEST['weight3'],$_REQUEST['reps3'],3,$workoutId,$movementId);
        header("Location: new-workout.php");
        exit;
    };

    if (isset( $_REQUEST['movements'])  && $_REQUEST['movements']=='new'){
        
    //InsertNewMovement($_POST['movementName'],$_POST['movementType']);
    }


?>

<html>
    <head>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <form action="" method="post">
            <h1>New Program:</h1>

            Program Name: <input type="text" name="workoutName" style="height:100px;width:500px;">
            <br>

            <select name="movements" onchange=" ShowText(this.value)" >
                <?php MovementDropdown();?>
            </select>

            <br>
            set1 weight: <input type="number" name="weight1" > reps: <input type="number" name="reps1" > 
            <br>
            set2 weight: <input type="number" name="weight2" > reps: <input type="number" name="reps2" > 
            <br>
            set3 weight: <input type="number" name="weight3" > reps: <input type="number" name="reps3" > 
            <br>

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

<script>
    function ShowText(selectedValue){
        if (selectedValue === "new") {
            const element = document.getElementById("popUp");
            element.classList.add('surprisetext');
        }
    }
    function HidePopup(){
            const element = document.getElementById("popUp");

            element.classList.remove('surprisetext');
        
    }
    
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
    
</script>

