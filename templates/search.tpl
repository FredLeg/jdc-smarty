{include file='partials/header.tpl'}

	<h1>Recherche</h1>

	<hr>

	<form action="search.php" method="GET">
		<div class="form-group">
			<label for="name"></label>
			<input type="text" class="form-control" name="search" id="search" placeholder="Recherche..." value="{$search->input}">
		</div>
		<button type="submit" class="btn btn-default">Rechercher</button>
	</form>

	{if !empty($search->results)}

	<hr>

	<h2>{$search->count} résultat(s) pour la recherche "{$search->input}"</h2>

	<div class="search-results list-group">

		{foreach $search->results as $post}
		<a href="post.php?id={$post->id}" class="list-group-item">
			<h4 class="list-group-item-heading">{$post->author} ({$post->creation_date})</h4>
			<p class="list-group-item-text">
				{Utils::cutString($post->content, 100)}
			</p>
		</a>
		{/foreach}

	</div>

	{/if}

{include file='partials/footer.tpl'}