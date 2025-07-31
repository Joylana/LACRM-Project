<?php
    include('include/init.php');
    NavBar();

    echo "<h1>".$_REQUEST['bodyPartName']."</h1>";

    if (isset($_POST["measurement"])){ // inserting rows on submit, page should reload on this action so show new datapoints

        NewMeasurement($_POST['bodyPartId'],$_POST['measurement'],$_SESSION['userId']);

    }
    
    $allMeasurements = GetAllMeasurements($_REQUEST['bodyPartId'],$_SESSION['userId']);

    if(!empty($allMeasurements)){
        $measurements = ProcessMeasurements($allMeasurements);

        echo '
        
        <script>

        window.addEventListener("load", function() {
            
            var chart = new CanvasJS.Chart("graphContainer", {
                title: {
                    text: "Previous Measurements",
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
                    dataPoints: '.  json_encode($measurements, JSON_NUMERIC_CHECK).'
                }]
            });
            chart.render();
            });

        </script>';
    }
    ?>
    <head>
        <script src="/include/js_functions.js"></script>
        <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
    </head>

    <div style="text-align:right;"">
        <span style="float:left">History</span>
        <button style="background-color:white;" class="workout-button" onclick="Show('popUpForm')">+New Entry</button>
    </div>
    <br>

    <form  class="sneakytext" action="" method="post" id="popUpForm" > 
        <div class="set-display">
            <?php 
            echo '<input type=hidden name="bodyPartId" value="'.$_REQUEST['bodyPartId'].'">';
            echo date("Y-m-d"); ?>
            <input style="margin:0px;width:40%" class="workout-input-box repwrapper" style='font-size:40px;width:250px' type="text" name="measurement" id="measurement">
            
        </div>
        <br>
        <div style="text-align:center">
            <input class='big-workout-button' type="submit"  >
        </div>

    </form>

    <div style="height:500px" id="graphContainer"></div>
    <?php
    foreach($allMeasurements as $m){
        echo "<div style='text-align:center' class='set-display'>".$m['dateLogged']." ".$m['size']."</div><br>";
    }
    ?>
</body>
</html>