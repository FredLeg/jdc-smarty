<?php
require_once 'inc/config.php';

if (empty($_GET['id'])) {
	header('Location: index.php');
	exit();
}

$id = intval($_GET['id']);

$post = Post::get($id);

if (empty($post)) {
	header('Location: index.php');
	exit();
}

$back_link = 'index.php';
if (!empty($_SERVER['HTTP_REFERER'])) {
	$back_link = $_SERVER['HTTP_REFERER'];
}

$vars = array(
	'post' => $post,
	'back_link' => $back_link
);

Post::displayTemplate('post.tpl', $vars);