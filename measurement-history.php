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
        echo '<div class="movement-input-box">
        <span >'.$part.'</span>
        <span style="float: right;">'.$part.'</span>
        </div>';
        $i += 1;
    }
?>
</div>