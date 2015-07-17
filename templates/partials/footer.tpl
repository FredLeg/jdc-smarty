	{if !isset($current_date)}
		{assign var=current_date value=date('Y')}
	{/if}

	</div><!-- .container -->

	<footer class="footer">
		<div class="container">
			<p class="text-muted">Les Joies du Code © {$current_date}</p>
		</div>
	</footer>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
</body>
</html>