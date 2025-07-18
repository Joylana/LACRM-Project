<?php 
    include('include/init.php');
    
?>
<html>

    <body>
        <?php NavBar(); 
        $user = GetUser($_SESSION['userId']); // Greeting the user
        echo "<h1 style='margin:10px' >Hi <br>
        ".$user['userFirstName']."!
        </h1>";
        ?>
        
        <div style="margin:45px" >
            <div class="text-box" style="padding:125px 0;">
                 <a  href="programs-page.php">Programs</a> <br>
            </div>
            <div class="text-box" style="padding:125px 0;">
                <a href="workout-history.php">Workout History</a> <br>
            </div>
            <div class="text-box" style="padding:125px 0;">
                <a  href="movement-history.php">Movement History</a> <br>
            </div>
            <div class="text-box" style="padding:125px 0;">
                <a  href="workout-view.php">Start New Workout</a> <br>
            </div>
        </div>

    </body>
</html>

