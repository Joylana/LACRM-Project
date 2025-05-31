<?php
    include('include/init.php');

    if (isset( $_REQUEST['title']) && isset($_REQUEST['content']) && isset($_REQUEST['description'])){
        InsertComment($_REQUEST['title'],$_REQUEST['content'],$_REQUEST['description']);
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
            submit: <input type="submit"  >

        </form>
    </body>
</html>

