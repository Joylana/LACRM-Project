<?php
    include('include/init.php');
    if(isset($_REQUEST['index'])){
        $Test = GetPost( $_REQUEST['index'] );

    }

    echo "<h2>".$Test['title']."</h2>";



