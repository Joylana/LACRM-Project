<?php
	function echoHeader($pageTitle){ 
			echo "
			    <html>
			        <head>
			            <title>".$pageTitle."</title>
			            <link rel='stylesheet' type='text/css' href='/style.css'
			        </head>
			        <body>		            
			                <div class='navbar'>
				                <a href='/logout.php'> LogOut </a>
				                <a href='/user.php'> Profile </a>
				                <a href='/jobsForPerson.php'> Jobs </a>
			                </div>          
			";
	}

//If you want a footer you can add one this is the bare minimum
function echoFooter(){
	echo "
            <footer style='background-color: #463F3A; padding: 50px; clear: both;'> hey boo bear ;)
            <h2>Get in Touch</h2>
            <a style='color:rgb(43, 31, 12); ' href='https://www.linkedin.com/in/alana-joy-morrison/'target='_blank'>LinkedIn</a>
            
            </footer>
			</body>
		</html>
	";
}