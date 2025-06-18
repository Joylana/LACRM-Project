<?php

    include('include/connect.php');
    date_default_timezone_set('America/Chicago');//my time zone because I can
		
		// This should happen right after connect.php (config)
		// so other functions have access to the database
    include('include/db_query.php');
    include('include/queryfunctions.php');
		
    include('include/helper_functions.php');

    //hard coding user id as 1
    
    $userId = 1;

