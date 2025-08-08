<?php
    include('include/init.php');
        
    // Check if request method is POST
    if (isset($_POST["movementName"])) {
        InsertNewMovement($_POST['movementName'],$_POST['movementType']);
    } 