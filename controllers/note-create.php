<?php

$heading = "Create a Note";

require 'Database.php';

$config = require('config.php');

$db = new Database($config['database'], 'ajin', '123456');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $query = "insert into notes (body, user_id) values(:body, :user_id)";

    $notes = $db->query($query, [
        'body' => filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS),
        'user_id' => 1
    ]);
}



require "views/note-create.view.php";
