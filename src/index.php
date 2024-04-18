<?php
Phar::interceptFileFuncs();
define("ROOT", dirname(__FILE__));
define("PHAR_URL", 'phar://index.php/');

ob_start("ob_gzhandler");
session_name("plm45022");
session_start();

$routers = [
	'/' => '/inc/index.php',
	'/msg' => '/inc/ajax-msg.php',
	'/test' => '/inc/test.php'
];

$request = str_replace(
	['index.php', '.php', 'inc/', 'html/'], '',
	trim($_SERVER['REQUEST_URI'], '/')
);
$result = isset($routers["/$request"]) ? $routers["/$request"] : null;

if($result !== null && file_exists(ROOT . $result)) include_once ROOT . $result;
elseif ($result == null) include_once ROOT . '/static.php';