<?php

// This controller is responsible for showing the 'Edit a Note' page

use Core\App;

$db = App::resolve('Core\Database');

$currentUserId = 1;
// find the note
$query = "select * from notes where id = :id";

$note = $db->query($query, [
    'id' => $_GET['id']
])->findOrFail();

// authorize the user
authorize($note['user_id'] === $currentUserId);

view('notes/edit.view.php', [
    'heading' => 'Edit Note',
    'errors' => [],
    'note' => $note
]);
