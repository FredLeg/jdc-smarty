<?php
// @FIXME
//require_once 'inc/db.php';
//require_once 'inc/func.php';

global $protocol, $domain, $current_dir, $root_path, $root_dir;
$protocol = (@$_SERVER['HTTPS'] == 'on' ? 'https' : 'http'); // http
$domain = $_SERVER['HTTP_HOST']; // localhost
$current_dir = dirname($_SERVER['PHP_SELF']); // jdc
$current_path = $protocol.'://'.$domain.$current_dir; // http://localhost/jdc/admin/
$root_dir = str_replace(array('\\', 'inc'), array('/', ''), __DIR__); // C:/xampp/htdocs/jdc/
$root_path = $protocol.'://'.$domain.'/'.str_replace($_SERVER['DOCUMENT_ROOT'], '', $root_dir); // http://localhost/jdc/

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