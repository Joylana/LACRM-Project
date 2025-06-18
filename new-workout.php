<?php 
    include("include/init.php");

    if (isset( $_REQUEST['workoutName']) && isset($_REQUEST['movementName']) && isset($_REQUEST['weight1'])){
        $workoutId = InsertProgram($_REQUEST['workoutName'],$userId); // REMINDER: userId is currently hard coded 
        
        $movementId = InsertMovement($_REQUEST['movementName'],$_REQUEST['movementType'],1,$workoutId);

        InsertSet($_REQUEST['weight1'],$_REQUEST['reps1'],1,$workoutId,$movementId);
        InsertSet($_REQUEST['weight2'],$_REQUEST['reps2'],2,$workoutId,$movementId);
        InsertSet($_REQUEST['weight3'],$_REQUEST['reps3'],3,$workoutId,$movementId);
        header("Location: new-workout.php");
        exit;
    };

?>

<html>
    <body>
        <form action="" method="post">
            <h1>New Program:</h1>

            Program Name: <input type="text" name="workoutName" style="height:100px;width:500px;">
            <br>
            Movement: <input type="text" name="movementName" style="height:100px;width:500px;">
            <br>
            <select name="movementType" >
                <option value="push">Push</option>
                <option value="pull">Pull</option>
                <option value="legs">Legs</option>
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
    </body>
</html>