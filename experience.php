<?php
    include('include/init.php');
?>

<!DOCTYPE html>
    <head>
        <meta charset="'utf-8" >
        <title>Joy's Experience</title>
        <link rel="stylesheet" href="mystyle.css">
    </head>

    <body style ="margin: 0px;">
  
        <h1 class = pagetitles> My<br>Experience</h1>
            
        <p>
            Tags:
            
        </p>
        <p style ="text-align: center;">
        <div class="float-container" >
            
            <?php
            $tag = $_REQUEST['tag'];
            $tags_array = ['cultural','work','volunteer'];
            ?>

            <?php

            if ($tag == 'all'){
                $Posts = GetAllPosts();
                foreach ($Posts as $p){

                    echo "<div class='float-child'> <div><a style='color:black' href='post-view.php?index=".$p['postId']."'> ".htmlspecialchars($p['title'])." </a> </div> </div>";
                        
                };
            }else {
                $Posts = GetTaggedPosts($tag);
                foreach ($Posts as $p){

                    echo "<div class='float-child'> <div><a style='color:black' href='post-view.php?index=".$p['postId']."'> ".htmlspecialchars($p['title'])." </a> </div> </div>";
                        
                };
            }
            ?>
            
        </div>
        </p>

        <?php echoFooter() ?>
    </body>

