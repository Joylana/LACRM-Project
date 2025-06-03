<?php
    include('include/init.php');

    if (isset( $_REQUEST['title']) && isset($_REQUEST['content']) && isset($_REQUEST['description'])){
        InsertExperience($_REQUEST['title'],$_REQUEST['content'],$_REQUEST['description'],$_REQUEST['tag']);
        header("Location: forms.php");
        exit;
    };
?>
<html>
    <body>
        <form action="" method="post">
            <h1>Add New Experiences Here:</h1>
            Title: <input type="text" name="title" >
            <br>
            Description: <input type="text" name="description" style="height:100px;width:500px;">
            <br>
            Content: <input type="text" name="content" style="height:100px;width:500px;">
            <br>
            Tag: cultural,work,volunteer <input type="text" name="tag" >
            <br>
            submit: <input type="submit"  >

        </form>

        <h1>Click to Edit Experiences Here:</h1>

        <?php // displaying tiles for experience

            $Posts = GetAllPosts();
            foreach ($Posts as $p){

                echo "<div class='float-child'> <div><a style='color:black' href='post-edit.php?index=".htmlspecialchars($p['postId'])."'> ".htmlspecialchars($p['title'])." </a> </div> </div>";
                        
            };

        ?>

    </body>
</html>

