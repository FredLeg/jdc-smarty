<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$files = glob('../templates/partials/*.tpl');

//print_r($files);

foreach($files as $file) {

	$new_file = str_replace('.php', '.tpl', $file);

	/*
	$content = file_get_contents($file);
	$new_content = str_replace(array('<?php', '<?=', '?>'), array('{', '{', '}'), $content);
	$result = file_put_contents($file, $new_content);
	echo $file.' => '.($result ? 'OK' : 'NOK').'<br>';
	*/

	//$result = rename($file, $new_file);
	//echo $file.' => '.$new_file.'|'.var_export($result, true).'<br>';
}