<div class="post">
    <p>{$post->getCreationDate('d-m-Y H:i:s')} par <a href="#">{$post->author}</a></p>
    <blockquote>
      <p>
		{if $max_length > 0}
			{Utils::cutString($post->content, $max_length, "... <a href=\"post/{$post->id}-{Utils::slugify($post->title)}\">Lire la suite</a>")}
		{else}
			{$post->content|nl2br}
		{/if}
      </p>
    </blockquote>
</div>