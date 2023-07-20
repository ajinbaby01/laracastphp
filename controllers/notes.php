<?php

$heading = "Notes";

require 'Database.php';

$config = require('config.php');

$db = new Database($config['database'], 'ajin', '123456');

$query = "select * from notes where user_id = 2";


$notes = $db->query($query)->findAll();

require "views/notes.view.php";
