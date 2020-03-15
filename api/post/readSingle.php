<?php

//headers

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

require "../../config/Database.php";
require "../../models/Post.php";

//create database object and connect
$database = new Database();

$post = new Post($database);

//blog post query

// $result = $post->read();
// echo $_GET['id'];
$id = isset($_GET['id']) ?: die('no entry received');

$post->readSingle((int)$id);

$singlePost = [
    'id' => (int)$post->id,
    'title' => $post->title,
    'body' => $post->body,
    'author' => $post->author,
    'category_id' => $post->category_id,
    'category_id' => $post->category_name
];

//mke it json
print(json_encode($singlePost));


?>