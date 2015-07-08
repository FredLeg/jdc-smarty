<?php
include_once 'header.php';

$posts = Post::getList('SELECT * FROM posts ORDER BY creation_date DESC LIMIT 10');
?>

		<h1>Les dernières Joies du code</h1>

		<hr>

		<?php
		foreach($posts as $post) {
			echo Post::displayPost($post, 100);
			echo '<hr>';
		}
		?>

<?php include_once 'footer.php' ?>