{include file='partials/header.tpl'}

	<h1>Envoyez votre Joie du code</h1>

	<hr>

	{if !empty($errors)}
	<div class="alert alert-danger" role="danger">
	{foreach $errors as $key => $error}
		{$error}<br>
	{/foreach}
	</div>
	{/if}

	<form action="send.php" method="POST">
		<div class="form-group{if !empty($errors['author'])} has-error{/if}">
			<label for="author">Votre nom</label>
			<input type="text" class="form-control" name="author" id="author" placeholder="Entrez votre nom" value="{$author}">
		</div>
		<div class="form-group{if !empty($errors['content'])} has-error{/if}">
			<label for="content">Votre Joie de code</label>
			<textarea name="content" id="content" class="form-control" rows="5" placeholder="Contenu de votre Joie de code">{$content}</textarea>
		</div>
		<button type="submit" class="btn btn-default">Envoyer</button>
	</form>

{include file='partials/footer.tpl'}