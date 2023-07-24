<?php

/* App Root */
define("APP_ROOT", dirname(__FILE__));
require_once 'vendor/autoload.php';

$controller = new \App\Controllers\CliController();
$controller->exec();