<?php

use Core\App;

$currentUserId = 1;

$db = App::resolve('Core\Database');

//making sure note deleted is by the current user
$query = "select * from notes where id = :id";

$note = $db->query($query, [
    'id' => $_POST['id']
])->findOrFail();

authorize($note['user_id'] === $currentUserId);

$query = "delete from notes where id = :id";
$db->query($query, [
    'id' => $_POST['id']
]);

redirect('/notes');
