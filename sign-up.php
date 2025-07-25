<?php
    include('include/init.php');
    NavBar();
    
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
        <br>
        Goal: 
        <br>
        <input class="text-box signup-box" type="text" name="username" >
        <br>
        Weight: 
        <br>
        <input class="text-box signup-box" type="text" name="password" >
        <div style="text-align:center;">
        <input style="background-color:0D0C1D; text-align:center;color: white;width:35%;padding:15px;font-size:25px;margin-bottom:10px" type="submit" value="Sign Up" />
        </div>
    </form>
    </div>