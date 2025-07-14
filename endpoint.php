<?php 
include('include/init.php');

    // reminder that this is not form data and needs to be handled differently
    $json = file_get_contents('php://input');

    // Decode it into an associative array
    $data = json_decode($json, true);

    // Access the value
    $movementValue = $data['value'] ?? null;
    MovementDropdown($movementValue);
    ?>