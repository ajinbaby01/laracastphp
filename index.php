<?php

require 'functions.php';
//require 'router.php';
require 'Database.php';

$config = require('config.php');

$db = new Database($config['database'], 'ajin', '123456');

$query = "select * from posts";

$posts = $db->query($query)->fetchAll();

dd($posts);

?>
