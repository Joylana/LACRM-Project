<?php
    include('include/init.php');
    if(isset($_REQUEST['index'])){
        $post = GetPost( $_REQUEST['index'] );
        
    }
    $title = $post['title'];

    if(isset( $_REQUEST['title'])){
        $edit = $_REQUEST['title'];
        EditPost($title,'title',$edit);
        header("Location: forms.php");
        exit; 
    }else if (isset( $_REQUEST['description'])){
        $edit = $_REQUEST['description'];
        EditPost($title,'description',$edit);
        header("Location: forms.php");
        exit;
    }else if (isset( $_REQUEST['content'])){
        $edit = $_REQUEST['content'];
        EditPost($title,'content',$edit);
        header("Location: forms.php");
        exit;
    }else if (isset( $_REQUEST['tag'])){
        $edit = $_REQUEST['tag'];
        EditPost($title,'tag',$edit);
        header("Location: forms.php");
        exit;
    };

    ?>

<html>
    <body>
        <!-- display the title -->
        <h1> <?php echo $title ?> </h1>

        <h2>Edit title</h2>
        <form action="" method="post">
            Title: <input type="text" name="title" >
            submit: <input type="submit"  >
        </form>

        <h2>Edit description</h2>
        <form action="" method="post">
            Description: <input type="text" name="description" >
            submit: <input type="submit"  >
        </form>

        <h2>Edit content</h2>
        <form action="" method="post">
            Content: <input type="text" name="content" >
            submit: <input type="submit"  >
        </form>

        <h2>Edit tag: work, cultural, volunteer</h2>
        <form action="" method="post">
            Tag: <input type="text" name="tag" >
            submit: <input type="submit"  >
        </form>
 


    </body>
</html>