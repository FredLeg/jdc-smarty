{include file='partials/header.tpl'}

	<h1>Les dernières Joies du code</h1>

	<hr>

	{foreach $posts as $post}
		{Post::displayPost($post, 100)}
		<hr>
	{/foreach}

{include file='partials/footer.tpl'}