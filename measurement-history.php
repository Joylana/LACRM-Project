<?php
    include('include/init.php');
    NavBar();
    $bodyParts = [
        1=>'Weight',
        2=>'Waist',
        3=>'Neck',
        4=>'Hips',
        5=>'Arms',
        6=>'Thigh',
        7=>'Calves'
    ]
    ?>
    <h1>Measurement Log</h1>
<div style="margin:20px">
<?php 
    $i = 1;
    foreach($bodyParts as $part){
        //retreive latest entry for each
        $latestMeasurement = GetLatestMeasurement($i,$_SESSION['userId']);

        echo '<a style="display: block;" class="movement-history-box" href="measurement-log.php?bodyPartId='.$i.'&bodyPartName='.$part.'">
        <span >'.$part.'</span>';
        if (!empty($latestMeasurement)){
        echo '<span style="float: right;">Last measurement: '.$latestMeasurement['size'].'</span>
        </a>';
        }else{
            echo "<span style='float: right;'>No Measurements yet</span>
            </a>";
        }
        $i += 1;
    }
?>
</div>