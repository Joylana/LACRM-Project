<?php 
include('include/init.php');

    $json = file_get_contents('php://input');

    // Decode it into an associative array
    $data = json_decode($json, true);

    // Access the value
    //why the hell does this work omg :,)
    $movementValue = $data['value'] ?? null;
    MovementDropdown($movementValue);
    ?>