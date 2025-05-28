<?php

	// $Posts = [
	// 	1 => [
	// 		'postID' => 1,
    //         'title' => 'Multicultural Scholars Program',
	// 	],
	// 	2 => [
    //         'postID' => 2,
    //         'title' => 'METAL',
		
	// 	],
    //     3 => [
    //         'postID' => 3,
    //         'title' => 'FIRST Robotics',
		
	// 	],
	// ];

	// function GetAllPosts(){
	// 	$Posts = [
	// 		1 => [
	// 			'postID' => 1,
	// 			'title' => 'About Me',
	// 		],
	// 		2 => [
	// 			'postID' => 2,
	// 			'title' => 'METAL',
			
	// 		],
	// 		3 => [
	// 			'postID' => 3,
	// 			'title' => 'FIRST Robotics',
			
	// 		],
	// 	];
	// 	return $Posts;
			
	// }

	function GetAllPosts(){

		$posts = dbQuery("
			SELECT * FROM posts
		")-> fetchAll();

		return $posts;
	}

	function GetPost( $Num ){
		$All = GetAllPosts();
		return $All[$Num];
	}



