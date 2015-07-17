<?php
function class_autoload($class_name) {
	// @FIXME
	if (strpos($class_name, 'Facebook') !== false) {
		return false;
	}
    // @FIXME
    if (strpos($class_name, 'Smarty') !== false) {
        include_once 'class/Smarty/Smarty.class.php';
        return false;
    }

	global $root_dir;
    $class_path = $root_dir.'class/'.$class_name.'.class.php';
    if (file_exists($class_path)) {
        include $class_path;
        return true;
    }
    // On peut soulever une exception si le fichier n'existe pas
    throw new Exception('Class '.$class_name.' not found from path '.$class_path);
}
spl_autoload_register('class_autoload', true, true);