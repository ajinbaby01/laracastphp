<?php

require 'functions.php';
//require 'router.php';
require 'Database.php';

$db = new Database();

$posts = $db->query("select * from posts")->fetc(PDO::FETCH_ASSOC);

dd($posts);

?>
