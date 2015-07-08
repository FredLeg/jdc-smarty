<?php
include_once 'header.php';

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
?>

		<a href="<?= $back_link ?>" class="btn btn-info">Retour</a>

		<h1>Une Joie du code</h1>

		<hr>

		<?= Post::displayPost($post) ?>

<?php include_once 'footer.php' ?>