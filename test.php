<?php
    //include('include/init.php');
    date_default_timezone_set('America/Chicago');
    $id = date("his");
    echo $id;
    
    $add = rand(100000,889999);
    $id = $id +$add;

    echo "<br>generated id: ".$id;
    echo "time: ". date("h:i:s");
?>