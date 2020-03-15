<?php

//headers

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

require "../../config/Database.php";
require "../../models/Post.php";

//create database object and connect
$database = new Database();
// $database->connect();
// var_dump($database);
//instatiate blog post object

$post = new Post($database);

//blog post query

$result = $post->read();

//row count

$numberOfRows = $result->rowCount();

if($numberOfRows > 0){
    $postCollection = [];
    $postCollection['data'] = [];

    while($rows = $result->fetch(PDO::FETCH_ASSOC)){
        extract($rows);

        $postItems = [
            'id'=> $id,
            'title' => $title,
            'body' => html_entity_decode($body),
            'author' => $author,
            'category_id' => $category_id,
            'categoryName' => $categoryName
        ];

        //push to $postCollection['data']
        array_push($postCollection['data'], $postItems);
    }
    echo json_encode($postCollection);

}else{
     echo json_encode(['message' => 'no posts found']);
}


?>