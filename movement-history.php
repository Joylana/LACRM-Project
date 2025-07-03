<?php

use function PHPSTORM_META\elementType;

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
        $volumeData = GetVolume();
        //debugOutput($instances);
        $date = NULL;
        $x = 0;

        foreach($movements as $m){

            echo "<div style='background-color:lavender;padding:5px;margin:5px'>"; //opening div for each movement to have it's own little visual container

            echo "<div onclick='Show(".$m['movementId'].")' >↓".$m['movementName']."</div>".'<br>';
            $count = 0;
            echo "<div  class='sneakytext'  id=".$m['movementId']." >"; 

            // display graph here :)
            // issue with using window.onload
            $volume = SeperateVolumes($m['movementId'],$volumeData);

            if(!empty($volume)){

            echo '
                
                <script>

                window.addEventListener("load", function() {
                    
                    var chart = new CanvasJS.Chart("'. json_encode($x, JSON_UNESCAPED_UNICODE) .'", {
                        title: {
                            text: "Previous Volume"
                        },
                        axisY: {
                            title: "Volume"
                        },
                        data: [{
                            type: "line",
                            dataPoints: '.  json_encode($volume, JSON_NUMERIC_CHECK).'
                        }]
                    });
                    chart.render();
                    });

                </script>
                
                <div id="'.$x.'" style="height: 27%; width: 100%;"></div>
                ';}
                //debugOutput(SeperateVolumes($m['movementId'],$volumeData));
                $x+=1;
            

            foreach($instances as $i){

                            
                
                if ($i['movementId']==$m['movementId']){ // if it matches the current movement
                    $count+=1; //increments for each set that is shown
                    
                    $newDate = $i['dateTimeStarted'];
                    if($date == NULL or $date!=$newDate){ //if it's a new date it will echo it
                        echo $i['dateTimeStarted']. "<br>";
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
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>