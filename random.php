<?php
include_once 'header.php';

$post = Post::getRandom('SELECT * FROM posts ORDER BY RAND() LIMIT 1');
?>

		<h1>Une Joie du code au hasard</h1>

		<hr>

		<?= Post::displayPost($post) ?>

<?php include_once 'footer.php' ?>