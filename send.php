<?php
require_once 'inc/config.php';

$author = !empty($_POST['author']) ? strip_tags($_POST['author']) : '';
$content = !empty($_POST['content']) ? htmlspecialchars($_POST['content']) : '';

$errors = array();

if (!empty($_POST)) {

	$post = new Post();

	foreach($_POST as $key => $value) {
		try {
			$post->$key = $value;
		} catch (Exception $e) {
			$errors[$key] = $e->getMessage();
		}
	}

	if (empty($errors)) {

		$result_id = $post->insert();

		if ($result_id > 0)	{
			header('Location: post.php?id='.$result_id);
			exit();
		}

		$errors['internal error'] = 'An error occured, please try again later';
	}

}

$vars = array(
	'author' => $author,
	'content' => $content,
	'errors' => $errors
);

Post::displayTemplate('send.tpl', $vars);