<?php 
    include('include/init.php');
    $workoutId = $_REQUEST['workoutId'];
    $program = GetProgram($workoutId,$_SESSION["userId"]);
       
    $movements = GetMovementsForWorkout($workoutId);
    $sets = GetSetsForWorkout($workoutId);

    NavBar(1);
    echo "<h1>".$program['workoutName']."</h1>";
    echo " <div class='big-workout-button'> 
    <div style='margin-top:25px;font-size:2vh'>
    <a  href='workout-view.php?workoutId=". $workoutId ."'> Start Workout </a> 
    </div>
    </div>
    <div style='margin:20px;text-align:center'>
    ";

    foreach($movements as $m){//displaying current program info
        echo "<br>
        <div style='font-size:2vh;text-align:left'>".$m['movementName']."</div>
        <br>";
        foreach($sets as $s){
            if ($s['instanceId'] == $m['instanceId'])
            echo "<div class='set-display'> weight: ". $s['weight'] ." Reps: ". $s['reps'] ."</div><br>";
        }
    
    }
    echo " <div class='big-workout-button' style='height:50px;font-size:2vh'>
    <a href='program-edit.php?workoutId=". $workoutId ."'> Edit Program </a> 
    </div>
    </div>";

?>

