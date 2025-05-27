<?php
    if(isset($_POST['index'])){
        $Test = GetPost( htmlspecialchars($_GET['index']) );
        echo $Test ;
        var_dump($_GET['index']);
    }