<?php
require_once 'inc/config.php';

$post = Post::getRandom('SELECT * FROM posts ORDER BY RAND() LIMIT 1');

$back_link = 'index.php';
if (!empty($_SERVER['HTTP_REFERER'])) {
	$back_link = $_SERVER['HTTP_REFERER'];
}

$vars = array(
	'post' => $post,
	'back_link' => $back_link
);

Post::displayTemplate('post.tpl', $vars);