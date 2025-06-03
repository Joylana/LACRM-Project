<?php
    function GetComments(){
        $comments = dbQuery(
            "Select *
            From comments"
        )->fetchAll();
        return $comments;
    };

// function to insert experiences into the database is an easier format
    function InsertExperience($title,$content,$description,$tag){
        $now = date_create('now');
        $dateCreated = date_format($now,"Y-m-d");
        dbQuery(
            "INSERT INTO posts(title, content, description,tag, dateCreated)
            VALUES (:title,:content,:description,:tag,:dateCreated)",
            [
                'title'=> $title,
                'content'=>$content,
                'description'=>$description,
                'tag'=>$tag,
                'dateCreated' =>$dateCreated
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

//function to archive posts

    function ArchivePost($title){
        $now = date_create('now');
        $dateArchived = date_format($now,"Y-m-d");
        dbQuery("
         UPDATE posts SET dateArchived = '".$dateArchived."'
          WHERE title = '".$title."'
        ");
    }

//function to edit posts
    function EditPost($title,$field,$edit){
         dbQuery("
            UPDATE posts SET ".$field."='".$edit."'
            WHERE title = '".$title."'
         ");
    }