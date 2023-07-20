<?php

$heading = "Note";
$currentUserId = 2;

require 'Database.php';

$config = require('config.php');

$db = new Database($config['database'], 'ajin', '123456');

$query = "select * from notes where id = :id";


$note = $db->query($query, [
    ':id' => $_GET['id']
    ])->fetch();

if(! $note){
    abort();
}

if($note['user_id'] !== $currentUserId){
    abort(Response::HTTP_FORBIDDEN);
}

require "views/note.view.php";
