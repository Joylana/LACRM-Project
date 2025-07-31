<?php
    include('include/init.php');
    NavBar();

    echo "<h1>".$_REQUEST['bodyPartName']."</h1>";
    
    $allMeasurements = GetAllMeasurements($_REQUEST['bodyPartId'],$_SESSION['userId']);
    debugOutput($allMeasurements);
    ?>