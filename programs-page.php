<?php 
    include('include/init.php');

    $programs = GetPrograms($_SESSION["userId"]);
    NavBar();

?>
        <h1 style="margin:10px">Programs</h1>
        <div style="margin:45px;">
            <div class="text-box" style="padding:40px 0;font-size:40px;height:2.5%" >
                <a href='new-program.php'>New Program</a>
            </div>
        

        <?php //displaying saved programs
        foreach ($programs as $p){
            echo " 
            <div class='text-box' style='padding:40px 0;text-align:left;' >
            <a style='margin-left:25px' href='program-view.php?workoutId=". $p['workoutId'] ."'>". $p['workoutName'] ."</a> 
            </div>
            ";
        }
        ?>
        </div>
    </body>
</html>