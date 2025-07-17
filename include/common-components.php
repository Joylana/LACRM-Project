<?php

    function NavBar($back=NULL){ 
        echo "
            <html>
                <head>
                    <link rel='stylesheet' type='text/css' href='/style.css'>
                    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
                </head>
            <body style = 'margin:0'>	
        ";
        if($back == NULL){
            echo"
                	            
                <div class='navbar'>
                <div style='float:right; padding:20px'>

                <a href='homepage.php'>
                    <img  style='height: 80%' src='home-icon.png' alt='home'>
                </a>

                </div>

                </div>    
            ";

        }else{ // gonna fix the back button positioning when working on programs-page
            echo"	            
                <div class='navbar'>

                <div style='float:left; padding:20px'>

                <a style='color: white;font-size:300%' href='programs-page.php'>
                    < Back
                </a>

                </div>

                <div style='float:right; padding:20px'>

                <a href='homepage.php'>
                    <img  src='home-icon.png' alt='home'>
                </a>

                </div>

                </div>    
            ";
        }
    }

?>