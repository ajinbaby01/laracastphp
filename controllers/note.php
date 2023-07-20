<?php

$heading = "Note";

require 'Database.php';

$config = require('config.php');

$db = new Database($config['database'], 'ajin', '123456');

$query = "select * from notes where id = :id";


$note = $db->query($query, [':id' => $_GET['id']])->fetch();

require "views/note.view.php";
