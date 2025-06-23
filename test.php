<?php
    include("include/init.php");
    $movements = GetAllMovements();
    debugOutput($movements);
    foreach($movements as $m){
        echo " <option value='".$m[movementId]."'>".$m[movementName]."</option> ";
    } 
    ?>