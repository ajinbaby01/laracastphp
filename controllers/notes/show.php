<?php
use Core\Database;

$currentUserId = 1;

$config = require base_path('config.php');

$db = new Database($config['database'], 'ajin', '123456');

if ($_SERVER['REQUEST_METHOD'] === 'POST') { //form was submitted

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
} else {
    $query = "select * from notes where id = :id";

    $note = $db->query($query, [
        'id' => $_GET['id']
    ])->findOrFail();

    authorize($note['user_id'] === $currentUserId);

    view('notes/show.view.php', [
        'heading' => 'Note',
        'note' => $note
    ]);
}
