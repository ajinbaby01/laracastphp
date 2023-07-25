<?php

// This controller is responsible for showing the 'Edit a Note' page
use Core\App;
use Core\Validator;

$currentUserId = 1;

$errors = [];

$db = App::resolve('Core\Database');

// find the note
$query = "select * from notes where id = :id";

$note = $db->query($query, [
    'id' => $_POST['id']
])->findOrFail();

// authorize the user
authorize($note['user_id'] === $currentUserId);

// validate the form
if (!Validator::string($_POST['body'], 1, 1000)) {
    $errors['body'] = 'A body of no more than 1000 characters is required';
}

// form has no errors
if (empty($errors)) {
    $query = "update notes set body = :body where id = :id";
    $db->query($query, [
        'body' => filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS),
        'id' => $_POST['id']
    ]);

    redirect('/notes');

}

view('notes/edit.view.php', [
    'heading' => 'Edit Note',
    'errors' => $errors,
    'note' => $note
]);
