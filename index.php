<?php
    include('include/init.php');
    ?>

<!DOCTYPE html >
    <head >
        <meta charset="'utf-8" name="viewport" content="width=device-width">
        <title>Joy</title>
        <link rel="stylesheet" href="mystyle.css">
        <!--<style>
            body{
                background-image: linear-gradient(white 45%, pink 70%);
                
            }
        </style>-->
    </head>


<body style="margin: 0; background-image: linear-gradient(white 45%, pink 70%);">
    <h1 style="text-align: center; margin: 15%; padding:15%; ">Alana Joy Morrison</h1>


<div style="background-image: linear-gradient(rgba(255, 192, 203, 0.04) 400px, #95B2B8 52% );">
<!-- About me section-->
    <div style="background-color:pink;border-radius: 25px;padding: 20px;">
        <h2>About Me</h2>
        <img src="me photo.jpeg" alt="image of alana" style="  height: 10%;width: 10%;"/>
        <p class="body">
            I'm so beautiful and so are you. 
            I am a Computer Science student at Maryville University graduating in spring 2026.
            FIRST Robotics Alumnus with 7 years volunteering experience.

        </p>
    </div>
    <div style="background-color:rgba(255, 255, 255, 0) ; padding: 50px"></div> <!-- adding space between tiles-->

<div style="background-image: linear-gradient(rgba(255, 255, 255, 0) 1px, #95B2B8 42%, #463F3A );">

<!-- At A Glance -->
    <div style="background-color: #95B2B8 ;border-radius: 30px;padding: 20px;">
        <h2>At a Glance</h2>

        <div class="index-float-container" >
            <div class='index-float-child'> <img src="IMG_0055.jpg" alt="image of alana" style="  height: 100%;width: 100%;"/> </div>
            <div class='index-float-child'>  I’m passionate about building ethical, intelligent systems and creating innovative solutions that make a real difference. Whether I’m coding a project, mentoring others, or organizing events, I bring energy, empathy, and a drive to make an impact. </div>
            <div class='index-float-child'> <img src="IMG_1428.jpg" alt="image of alana" style="  height: 100%;width: 100%;"/> </div>
            <div class='index-float-child'>Beyond the classroom, I’ve been deeply involved in leadership and community engagement. I’ve served as Executive Chair of the Campus Activities Board and the International Student Association, worked as an Orientation Coordinator, and supported new students as a Peer Mentor. </div>
            <div class='index-float-child'> <img src="IMG_0653.jpg" alt="image of alana" style="  height: 100%;width: 100%;"/> </div>
            <div class='index-float-child'>My passion for community building extends beyond campus—I’ve been a dedicated FIRST Robotics volunteer for over seven years, always looking for ways to give back. </div>
        </div>

        <div style="background-color:rgba(255, 255, 255, 0);clear: both;  padding: 1px"></div>
    </div>
    <div style="background-color:rgba(255, 255, 255, 0);clear: both;  padding: 50px"></div> <!-- adding space between tiles-->
    

<!-- Contact Me and Socials and other pages-->
    <div style="background-color: #463F3A ;border-radius: 30px;padding: 20px;">

            <h2>View My Work</h2>

            <a style="color:rgb(41, 89, 99)" href="experience.php?tag=all" target="_blank">Experience</a>
    <br> 
            <a style="color:rgb(41, 89, 99)" href="projects.php" target="_blank">Projects</a>
    <br> 
            <a style="color:rgb(41, 89, 99)" href="skills.php" target="_blank">Skills</a>


<br> 
</div>
</div>

    
    <?php echoFooter() ?>
    

</body>

