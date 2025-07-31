<?php
    include('include/init.php');
    NavBar();

    if(isset($_REQUEST['username']) && isset($_REQUEST['password'])){
        $password = password_hash($_REQUEST['password'],PASSWORD_BCRYPT);
        $_SESSION['userId'] = CreateNewUser($_REQUEST['firstname'], $_REQUEST['lastname'], $_REQUEST['username'], $password, $_REQUEST['goal'], $_REQUEST['weight']);
        header('Location: homepage.php');
        exit;

    }
    
?>

    <h1 style="text-align: left;"> Sign Up:</h1>
    <div style='font-size:2vh'>
    <form action=''method="POST" id='signup' >
        First Name: 
        <br>
        <input class="text-box signup-box" type="text" name="firstname" >
        <br>
        Last Name: 
        <br>
        <input class="text-box signup-box" type="text" name="lastname" >
        <br>
        Username: 
        <br>
        <input class="text-box signup-box" type="text" name="username" >
        <br>
        Password: 
        <br>
        <input class="text-box signup-box" type="text" name="password" >
        <div style='font-size:0.75em;color:rgba(13, 12, 29, 0.86)'>*Optional:</div>
        <br>
        Goal: 
        <br>
        <input class="text-box signup-box" type="text" name="goal" >
        <br>
        Weight: 
        <br>
        <input class="text-box signup-box" type="text" name="weight" >
        <div style="text-align:center;">
        <input style="background-color:0D0C1D; text-align:center;color: white;width:35%;padding:15px;font-size:25px;margin-bottom:10px" type="submit" value="Sign Up" />
        </div>
    </form>
    </div>