<?php 
    include('include/init.php');

?>
<html>
    <header>
        <link rel="stylesheet" href="style.css">
    </header>
    

    <body>
        <h1>Movement History</h1>


        <div style="padding:20px;line-height:25px">
        <?php // displaying movements
        $movements = GetAllMovements();
        $instances = GetAllInstances();
        //debugOutput($instances);
        $date = NULL;
        $elementIds = 0;

        foreach($movements as $m){

            echo "<div style='background-color:lavender;padding:5px;margin:5px'>"; //opening div for each movement to have it's own little visual container

            $elementIds+=1;
            echo "<div onclick='Show(".$elementIds.")'>↓".$m['movementName']."</div>".'<br>';
            $count = 0;
            echo "<div  class='sneakytext' id=".$elementIds." >"; 

            foreach($instances as $i){
                $elementIds+=1;

                            
                
                if ($i['movementId']==$m['movementId']){ // if it matches the current movement
                    $count+=1; //increments for each set that is shown
                    
                    $newDate = $i['dateTimeStarted'];
                    if($date == NULL or $date!=$newDate){ //if it's a new date it will echo it
                        echo $i['dateTimeStarted']. "<br";
                        $date = $i['dateTimeStarted'];
                    }

                    echo "Reps:".$i['reps'] ." Weight:". $i['weight']."<br><br>"; //displays the reps and weights
                }
            
            }
            if($count == 0){ // only 0 if there were no sets to be shown, if it is zero it shows a message
                echo "No records";
            }
            echo "</div>"; // echoes closing tag for wrapper div that shows or hides movements
            
            echo "</div>"; // closing tag for whole movement box
            
        }

        ?>
        </div> 

    </body>
</html>
<script src="/include/js_functions.js"></script> <!--each movement history will pop up when clicked on-->