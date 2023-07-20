<?php

require 'Database.php';

$config = require('config.php');

$db = new Database($config['database'], 'ajin', '123456');

// $id = $_GET['id'];
dd($_GET);
$query = "select * from notes where id = :id";


$note = $db->query($query, [$id])->fetch();

$heading = 'Note';

require('views/note.view.php')

?>
