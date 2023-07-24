<?php

use Core\Database;

$currentUserId = 1;

$config = require base_path('config.php');

$db = new Database($config['database'], 'ajin', '123456');

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

header('location: /notes');
exit;
