<?php

$config = require base_path('config.php');

$db = new Database($config['database'], 'ajin', '123456');

$query = "select * from notes where user_id = 1";


$notes = $db->query($query)->findAll();

view('notes/index.view.php', [
    'heading' => 'My Notes',
    'notes' => $notes
]);
