<?php

require 'Database.php';

$config = require('config.php');

$db = new Database($config['database'], 'ajin', '123456');

// $id = $_GET['id'];
$query = "select * from notes where user_id = 1";


$notes = $db->query($query)->fetchAll();

require "views/notes.view.php";
