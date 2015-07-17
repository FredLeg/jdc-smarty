<?php
require_once 'inc/config.php';

$posts = Post::getList('SELECT * FROM posts ORDER BY creation_date DESC LIMIT 10');

$vars = array('posts' => $posts);

Post::displayTemplate('index.tpl', $vars);