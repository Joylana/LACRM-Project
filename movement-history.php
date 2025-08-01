<?php

    include('include/init.php');

    NavBar();

?>

        <h1>Movement History</h1>


        <div style="padding:20px;line-height:25px">
        <?php // displaying movements and graphs for volume progression
        $movements = GetAllMovements();
        $instances = GetAllInstances($_SESSION['userId']);
        $volumeData = GetVolume($_SESSION['userId']);
        $date = NULL;
        $graphElementId = 0; // incrementing id for the graph element so each is unique

        foreach($movements as $m){

            echo "<div class='movement-history-box'>"; //opening div for each movement to have it's own little visual container

            echo "<div style='font-size: 2.5vh;' onclick='Show(".$m['movementId'].")' >↓".$m['movementName']."</div>".'<br>';
            $dataShown = False;
            echo "<div  class='sneakytext'  id=".$m['movementId']." >"; 

            // displaying graph here :)
            $volume = SeperateVolumes($m['movementId'],$volumeData);

            if(!empty($volume)){ // displays graph as long as there is info to be displayed

                echo '
                    
                    <script>

                    window.addEventListener("load", function() {
                        
                        var chart = new CanvasJS.Chart("'. json_encode($graphElementId, JSON_UNESCAPED_UNICODE) .'", {
                            height:300,
                            width: 850,
                            title: {
                                text: "Previous Volume",
                                fontSize: 50
                            },
                            axisY: {
                                titleFontWeight: "light",
                                title: "Volume",
                                labelFontSize: 30
                            },
                            axisX: {
                                labelFontSize: 0
                            },
                            data: [{
                                color: "#0D0C1D",
                                type: "line",
                                dataPoints: '.  json_encode($volume, JSON_NUMERIC_CHECK).'
                            }]
                        });
                        chart.render();
                        });

                    </script>
                    
                    <div id="'.$graphElementId.'" style="height: 300px; width: 100%;margin-bottom:10px"></div>
                    ';
            }
                
            $graphElementId+=1; 
            

            foreach($instances as $i){

                            
                
                if ($i['movementId']==$m['movementId']){ // if it matches the current movement
                    $dataShown= True; //True if there is data to show
                    
                    $newDate = $i['dateTimeStarted'];
                    if($date == NULL or $date!=$newDate){ //if it's a new date it will echo it
                        echo substr($i['dateTimeStarted'],0,-9). "<br>
                        ";
                        $date = $i['dateTimeStarted'];
                    }

                    echo "<div style='font-size:100%' class='set-display'> Reps:".$i['reps'] ." Weight:". $i['weight']." </div>"; //displays the reps and weights
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