<?php
    include('include/init.php');
    if(isset($_REQUEST['index'])){
        $Test = GetPost( $_REQUEST['index'] );

    }

    echo "<h2>".$Test['title']."</h2><br>".

        $Test['description'].  "<br>".
        $Test['content']
    
    ;


    ?>
    



