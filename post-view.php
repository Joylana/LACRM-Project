<?php
    include('include/init.php');
    if(isset($_REQUEST['index'])){
        $Test = GetPost( $_REQUEST['index'] );

    }
    ?>
<html>
    <body style="background-color: ;">
    <?php

    echo "<h2>".$Test['title']."</h2><br>".

        $Test['description'].  "<br>".
        $Test['content']
    
    ;

    if ($Test['title'] == "Bachelors In Computer Science"){

        echo "<div style='font-size: 12px'>Relevant Coursework:</div>
            <ul class='a' style='font-size: 12px; margin-left: 5px;'>
            <li>Deep Learning</li>
            <li>Machine Learning</li>
            <li>Computer Vision</li>
            <li>Intro to Reinforcement Learning</li>
            <li>Intro to AI</li>
            <li>Big Data Analytics</li>
            <li>Text Mining</li>
            <li>Ethics of AI</li>
            <li>METAL</li>
            <li>Project Management</li>
            <li>Data Structures and Algorithms</li>
            </ul>";

    };


    ?>
    



