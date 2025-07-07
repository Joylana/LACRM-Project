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
    <body>
        <h1>Log In:</h1>
        <form action=''method="POST" id='login'>
            <input type="text" name="username" >
            <input type="text" name="password" >
            <input type="submit" value="Log In" />
        </form>
    </body>
</html>
