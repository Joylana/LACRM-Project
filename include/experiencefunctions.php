<?php
    function GetComments(){
        $comments = dbQuery(
            "Select *
            From comments"
        )->fetchAll();
        return $comments;
    };

// function to insert experiences into the database is an easier format
    function InsertExperience($title,$content,$description){
        $now = date_create('now');
        $dateCreated = date_format($now,"Y-m-d");
        dbQuery(
            "INSERT INTO posts(title, content, description, dateCreated)
            VALUES (:title,:content,:description,:dateCreated)",
            [
                'title'=> $name,
                'content'=>$content,
                'description'=>$description
            ]
        ) ;
    };

// function to get all rows of the database and store them in an array
    function GetAllPosts(){

	$posts = dbQuery("
		SELECT * FROM posts
	")-> fetchAll();

		return $posts;
	}

// function to get a post with a specific id, or any unique row entry
	function GetPost( $Num ){
		$All = GetAllPosts();
		return $All[$Num];
	}

//function to get posts of a certain tag
    function GetTaggedPosts($tag){
	$posts = dbQuery("
		SELECT * FROM posts  
        WHERE tag = '".$tag."'
	")-> fetchAll();

		return $posts;
    }