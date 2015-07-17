<?php
require_once 'inc/config.php';

$posts = Post::getList('SELECT * FROM posts ORDER BY creation_date DESC LIMIT 10');

$smarty = new Smarty;

$vars = array(
	'pages' => $pages,
	'current_page' => $current_page,
	'posts' => $posts
);

$smarty->assign($vars);

$smarty->display('index.tpl');