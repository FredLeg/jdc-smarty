<?php
// @FIXME
//require_once 'inc/db.php';
//require_once 'inc/func.php';

global $protocol, $domain, $current_dir, $root_path, $root_dir, $current_page, $pages;

$protocol = (@$_SERVER['HTTPS'] == 'on' ? 'https' : 'http'); // http
$domain = $_SERVER['HTTP_HOST']; // localhost

$current_script = $_SERVER['PHP_SELF']; // jdc/index.php
$current_dir = dirname($current_script); // jdc
$current_path = $protocol.'://'.$domain.$current_dir; // http://localhost/jdc/
$current_page = basename($current_script); // index.php

$root_dir = str_replace(array('\\', 'inc'), array('/', ''), __DIR__); // C:/xampp/htdocs/jdc/
$root_path = $protocol.'://'.$domain.'/'.str_replace($_SERVER['DOCUMENT_ROOT'], '', $root_dir); // http://localhost/jdc/

$pages = array(
    $root_path.'index.php' => 'Home',
    $root_path.'random.php' => 'JDC aléatoire',
    $root_path.'send.php' => 'Envoyer votre JDC',
    $root_path.'search.php' => 'Rechercher une JDC'
);

require_once 'autoload.php';