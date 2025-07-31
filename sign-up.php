<?php
    include('include/init.php');
    NavBar();

    if(isset($_REQUEST['username']) && isset($_REQUEST['password'])){
        $_SESSION['userId'] = CreateNewUser($_REQUEST['firstname'], $_REQUEST['lastname'], $_REQUEST['username'], $_REQUEST['password'], $_REQUEST['goal'], $_REQUEST['weight']);
        header('Location: homepage.php');
        exit;

    }
    
?>

    <h1 style="text-align: left;"> Sign Up:</h1>
    <div style='font-size:2vh'>
    <form action=''method="POST" id='signup' >
        <label for="firstname">First Name: </label>
        <br>
        <input class="text-box signup-box" type="text" name="firstname" id="firstname" >
        <br>
        <label for="lastname">Last Name: </label>
        <br>
        <input class="text-box signup-box" type="text" name="lastname" id="lastname" >
        <br>
        <label for="username">Username: </label>
        <br>
        <input class="text-box signup-box" type="text" name="username" id="username" >
        <br>
        <label for="password">Password: </label>
        <br>
        <input class="text-box signup-box" type="text" name="password" id="password" >
        <div style='font-size:0.75em;color:rgba(13, 12, 29, 0.86)'>*Optional:</div>
        <br>
        <label for="goal">Goal: </label>
        <br>
        <input class="text-box signup-box" type="text" name="goal" id="goal" >
        <br>
        <label for="weight">Weight: </label>
        <br>
        <input class="text-box signup-box" type="text" name="weight" id="weight" >
        <div style="text-align:center;">
        <input style="background-color:0D0C1D; text-align:center;color: white;width:35%;padding:15px;font-size:25px;margin-bottom:10px" type="submit" value="Sign Up" />
        </div>
    </form>
    </div>