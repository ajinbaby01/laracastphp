<?php

use Core\App;

$currentUserId = 1; // TODO => Make user_id dynamic

$db = App::resolve('Core\Database');

$query = "select * from notes where id = :id";

$note = $db->query($query, [
    'id' => $_GET['id']
])->findOrFail();

authorize($note['user_id'] === $currentUserId);

view('notes/show.view.php', [
    'heading' => 'Note',
    'note' => $note
]);
