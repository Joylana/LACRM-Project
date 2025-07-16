<?php
include('include/init.php');


if (isset($_POST['username'])){
    $id = VerifyUser($_POST['username'],$_POST['password']);

    if(!empty($id)){

        $_SESSION["userId"]=$id['userId'];
        header('Location: homepage.php');
        exit;

    }
    else{
        echo "Invalid username or password";
    }
}
?>

<html>
    
    <head>
        <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
        <link rel="stylesheet" href="style.css">
    </head>

    <body style="margin: 0;">
        <img style="width:100%;margin-top:0px" src="back-photo.jpg" alt="man flexing back muscles">

        <div style="text-align: center;">

            <h1> Log In:</h1>
            <form action=''method="POST" id='login'>
                <input type="text" name="username" >
                <br>
                <input type="text" name="password" >
                <br>
                <input type="submit" value="Log In" />
            </form>

        </div>

    </body>
</html>
