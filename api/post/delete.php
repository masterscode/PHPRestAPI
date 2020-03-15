<?php

//headers

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods,Content-Type, Authorization, X-Requested-With");

require "../../config/Database.php";
require "../../models/Post.php";

//create database object and connect
$database = new Database();

$post = new Post($database);

$incomingData = json_decode(file_get_contents("php://input"));
$post->setID($incomingData->id);

print $post->deletePost()?
        json_encode(['message' => 'post deleted'])
        :json_encode(['message' => 'post delete unsuccessful']);