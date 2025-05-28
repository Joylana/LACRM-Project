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
    <p>
        <h1>Experience</h1>
            


    </p>

            <?php
        $Posts = GetAllPosts();
        foreach ($Posts as $p){

            echo "<span> <a href='post-view.php?index=".$p['postId']."'> ".$p['title']." </a> </span>";
            
        };
    ?>

    <?php echoFooter() ?>
</body>
