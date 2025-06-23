<?php
    include('include/init.php');
        
    // Check if request method is POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        InsertNewMovement($_REQUEST['movementName'],$_REQUEST['movementType'],1);//add workoutId
    };