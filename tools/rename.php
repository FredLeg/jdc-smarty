<?php

$files = glob('../templates/partials/*.php');

//print_r($files);

foreach($files as $file) {

	$new_file = str_replace('.php', '.tpl', $file);

	//$result = rename($file, $new_file);
	//echo $file.' => '.$new_file.'|'.var_export($result, true).'<br>';
}