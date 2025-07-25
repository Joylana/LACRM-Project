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

        <div style="margin:25%;">

            <h1 style="text-align: left;"> Log In:</h1>
            <form action=''method="POST" id='login' >
                <input class="text-box" style="text-align:left" type="text" name="username" >
                <br>
                <input class="text-box" style="text-align:left" type="text" name="password" >
                <br>
                <div style="text-align:center;">
                <input style="background-color:0D0C1D; text-align:center;color: white;width:35%;padding:15px;font-size:25px;margin-bottom:10px" type="submit" value="Log In" />
                <br>
                <a href='sign-up.php'>Sign Up</a>
                </div>
            </form>

        </div>

    </body>
</html>
