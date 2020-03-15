<?php

//headers

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods,Content-Type, Authorization, X-Requested-With");

require "../../config/Database.php";
require "../../models/Post.php";

//create database object and connect
$database = new Database();

$post = new Post($database);

//get posted data
$incomingData = json_decode(file_get_contents("php://input"));

print $post->createPost($incomingData->id, $incomingData->title, $incomingData->body, $incomingData->author) 
? json_encode(['message' => 'post created']):json_encode(['message' => 'post unsuccessful']);