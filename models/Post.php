<?php

/*

*** @ YOU CANNOT REPLACE FIELD OR  TABLE NAMES THROUGH PARAMETERS

*/

class Post{
    //db operation
    private $connector; private $table = 'posts';

    //post properties
    public $id, $category_id, $title, $body, $author, $category_name, $created_at;

    public function __construct($db){
        $this->connector = $db;
        // var_dump($this->connector);
        }
    // get posts
    
    public function setID($id){
        return $this->id = $id;
    }
    public function read(){
        //create query
        $query = "SELECT c.name as categoryName, p.id, 
        p.category_id, 
        p.title, p.body, 
        p.author, p.created_at 
        FROM
        $this->table p
        LEFT JOIN
        category c ON p.category_id = c.id
        ORDER BY 
        p.created_at DESC";

        
        //prepare query
        $stmt = $this->connector->queryDB($query, []);
      
        return $stmt;

    }

    //get single post
    public function readSingle($id){
        $query = "SELECT c.name as categoryName, p.id, 
        p.category_id, 
        p.title, p.body, 
        p.author, p.created_at 
        FROM
        $this->table p
        LEFT JOIN
        category c ON p.category_id = c.id
        where p.id = :id
        LIMIT 1";        
        //prepare query
        $stmt = $this->connector->queryDB($query, ['id'=>$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $this->title = $row['title'];
        $this->id = $row['id'];
        $this->body = $row['body'];
        $this->author = $row['author'];
        $this->category_id = $row['category_id'];
        $this->category_name = $row['categoryName'];
    }

    //create a new post
    public function createPost($id, $title, $body, $author){
        $query = "INSERT INTO $this->table (
            category_id, title, body, author
        ) VALUES (
            :catid, :title, :body, :author
        )";

        return $this->connector->queryDB($query, 
        ['catid'=>$id, 'title'=>$title, 'body' =>$body, 'author'=> $author]);
    }

    public function updatePost($id, $title, $body, $author){
        $query = "UPDATE $this->table  
        SET 
        title = :title, 
        body = :body, 
        author = :author
        WHERE id = :id";

        return $this->connector->queryDB($query, 
        ['title'=>$title, 'body' =>$body, 'author'=> $author, 'id'=>$id]);
    }
    }
    
