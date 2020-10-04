<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers");
header("Access-Control-Allow-Origin", "http://localhost:8888/*");
header("HTTP/1.1 200 OK");
//ini_set('display_errors', '1');
//ini_set('display_startup_errors', '1');
//error_reporting(E_ALL);

define('WEBROOT', str_replace("Webroot/index.php", "", $_SERVER["SCRIPT_NAME"]));
define('ROOT', str_replace("Webroot/index.php", "", $_SERVER["SCRIPT_FILENAME"]));



require(ROOT . 'Config/core.php');

require('router.php');
require('request.php');
require('dispatcher.php');

$dispatch = new Dispatcher();
$dispatch->dispatch();
?>