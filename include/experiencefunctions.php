<?php
    function GetComments(){
        $comments = dbQuery(
            "Select *
            From comments"
        )->fetchAll();
        return $comments;
    };


    function InsertComment($title,$content,$description){
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

