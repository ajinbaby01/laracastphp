<?php

require 'Database.php';

$config = require('config.php');

$db = new Database($config['database'], 'ajin', '123456');

dd($_GET);
$query = "select * from notes where user_id = 1";


$notes = $db->query($query)->fetchAll();

$heading = 'Notes';

require "views/notes.view.php";
