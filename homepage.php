<?php 
    include('include/init.php');
    echo $_SESSION["userId"];
    
?>
<html>
    <header>
        <link rel="stylesheet" href="style.css">
    </header>
    <body>
        <h1>Home</h1>
        <a href="programs-page.php">Programs</a> <br>
        <a>Workout History</a> <br>
        <a href="movement-history.php">Movement History</a> <br>
    </body>
</html>

