<?php

// This controller is responsible for inserting data into database

use Core\App;
use Core\Validator;

$db = App::resolve('Core\Database');

$errors = [];

if (! Validator::string($_POST['body'], 1, 1000)) {
    $errors['body'] = 'A body of no more than 1000 characters is required';
}

if (empty($errors)) {
    $query = "insert into notes (body, user_id) values(:body, :user_id)";
    $db->query($query, [
        'body' => filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS),
        'user_id' => 1
    ]);

    header('location: /notes');
    exit;

}

//validation issue
view('notes/create.view.php', [
    'heading' => 'Create a Note',
    'errors' => $errors
]);

?>
