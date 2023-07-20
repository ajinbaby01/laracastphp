<?php

$heading = "Note";
$currentUserId = 1;

require 'Database.php';

$config = require('config.php');

$db = new Database($config['database'], 'ajin', '123456');

$query = "select * from notes where id = :id";


$note = $db->query($query, [
    ':id' => $_GET['id']
])->findOrFail();

authorize($note['user_id'] === $currentUserId);

require "views/notes/show.view.php";
