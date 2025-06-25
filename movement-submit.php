<?php
    include('include/init.php');
        
    // Check if request method is POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        InsertNewMovement($_POST['movementName'],$_POST['movementType']);
    };