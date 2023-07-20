<?php

require 'Validator.php';
require 'Database.php';

$heading = "Create a Note";

$config = require('config.php');

$db = new Database($config['database'], 'ajin', '123456');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $errors = [];

    if (!Validator::string($_POST['body'], 1, 1000)) {
        $errors['body'] = 'A body of no more than 1000 characters is required';
    }

    if (empty($errors)) {
        $query = "insert into notes (body, user_id) values(:body, :user_id)";
        $db->query($query, [
            'body' => filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            'user_id' => 1
        ]);
    }
}



require "views/note-create.view.php";
