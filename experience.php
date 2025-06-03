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
            
        <div style="margin: 100px;">
            Tags:<br>
            <?php
            $tags_array = ['cultural','work','volunteer'];
            foreach  ($tags_array as $t){
                echo "<span style='padding: 20px;'><a style='color:rgb(0, 0, 0)' href='experience.php?tag=".$t."'>".$t."</a></span>";
            }
            ?>

        </div>
        <div class="float-container" >
            
            <?php // displaying tiles for experience
            $tag = $_REQUEST['tag'];

            if ($tag == 'all'){  // display all posts
                $Posts = GetAllPosts();
                foreach ($Posts as $p){ 

                    echo "<div class='float-child'> <div><a style='color:black' href='post-view.php?index=".$p['postId']."'> ".htmlspecialchars($p['title'])." </a> </div> </div>";
                        
                };
            }else {  // diplay posts under the tag selected (url)
                $Posts = GetTaggedPosts($tag);
                foreach ($Posts as $p){

                    echo "<div class='float-child'> <div><a style='color:black' href='post-view.php?index=".$p['postId']."'> ".htmlspecialchars($p['title'])." </a> </div> </div>";
                        
                };
            }
            ?>
            
        </div>

        <?php echoFooter() ?>
    </body>

