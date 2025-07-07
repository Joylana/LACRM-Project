<?php

//use function PHPSTORM_META\elementType;

    include('include/init.php');

?>
<html>
    <header>
        <link rel="stylesheet" href="style.css">
    </header>
    

    <body>
        <h1>Movement History</h1>


        <div style="padding:20px;line-height:25px">
        <?php // displaying movements and graphs for volume progression
        $movements = GetAllMovements();
        $instances = GetAllInstances();
        $volumeData = GetVolume();
        $date = NULL;
        $graphElementId = 0; // incrementing id for

        foreach($movements as $m){

            echo "<div style='background-color:lavender;padding:5px;margin:5px'>"; //opening div for each movement to have it's own little visual container

            echo "<div onclick='Show(".$m['movementId'].")' >↓".$m['movementName']."</div>".'<br>';
            $dataShown = False;
            echo "<div  class='sneakytext'  id=".$m['movementId']." >"; 

            // displaying graph here :)
            $volume = SeperateVolumes($m['movementId'],$volumeData);

            if(!empty($volume)){ // displays graph as long as there is info to be displayed

                echo '
                    
                    <script>

                    window.addEventListener("load", function() {
                        
                        var chart = new CanvasJS.Chart("'. json_encode($graphElementId, JSON_UNESCAPED_UNICODE) .'", {
                            title: {
                                text: "Previous Volume",
                                fontSize: 20
                            },
                            axisY: {
                                titleFontWeight: "light",
                                title: "Volume"
                            },
                            data: [{
                                color: "#8e7cc3",
                                type: "line",
                                dataPoints: '.  json_encode($volume, JSON_NUMERIC_CHECK).'
                            }]
                        });
                        chart.render();
                        });

                    </script>
                    
                    <div id="'.$graphElementId.'" style="height: 50%; width: 100%;"></div>
                    ';
            }
                
            $graphElementId+=1; 
            

            foreach($instances as $i){

                            
                
                if ($i['movementId']==$m['movementId']){ // if it matches the current movement
                    $dataShown= True; //True if there is data to show
                    
                    $newDate = $i['dateTimeStarted'];
                    if($date == NULL or $date!=$newDate){ //if it's a new date it will echo it
                        echo $i['dateTimeStarted']. "<br>";
                        $date = $i['dateTimeStarted'];
                    }

                    echo "Reps:".$i['reps'] ." Weight:". $i['weight']."<br><br>"; //displays the reps and weights
                }
            
            }
            if($dataShown == False){ // only 0 if there were no sets to be shown, if it is zero it shows a message
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
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script> <!--library for graphs-->