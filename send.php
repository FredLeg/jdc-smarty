<?php
include_once 'header.php';

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
?>

	<h1>Envoyez votre Joie du code</h1>

	<hr>

	<?php if (!empty($errors)) { ?>
	<div class="alert alert-danger" role="danger">
	<?php
	foreach($errors as $key => $error) {
		echo $error.'<br>';
	}
	?>
	</div>
	<?php } ?>

	<form action="send.php" method="POST">
		<div class="form-group<?= !empty($errors['author']) ? ' has-error' : '' ?>">
			<label for="author">Votre nom</label>
			<input type="text" class="form-control" name="author" id="author" placeholder="Entrez votre nom" value="<?= $author ?>">
		</div>
		<div class="form-group<?= !empty($errors['content']) ? ' has-error' : '' ?>">
			<label for="content">Votre Joie de code</label>
			<textarea name="content" id="content" class="form-control" rows="5" placeholder="Contenu de votre Joie de code"><?= $content ?></textarea>
		</div>
		<button type="submit" class="btn btn-default">Envoyer</button>
	</form>

<?php include_once 'footer.php' ?>