<?php
require_once 'inc/config.php';

$input = !empty($_GET['search']) ? $_GET['search'] : '';

$search = new Search($input);

$vars = array(
	'search' => $search
);

Post::displayTemplate('search.tpl', $vars);