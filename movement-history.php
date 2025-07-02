<?php 
    include('include/init.php');
?>
<html>
    <header>
        <link rel="stylesheet" href="style.css">
    </header>
    

    <body>
        <?php
        $movements = GetAllMovements();
        foreach($movements as $m){
            $record = GetInstancesForMovements($m['movementId']);
            echo $m['movementName'];
            debugOutput($record);
        }
        ?>

    </body>
</html>