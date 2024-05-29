<?php

require_once dirname(__FILE__) . '/vendor/autoload.php';

$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

define('APP_ROOT', dirname(__FILE__));
define('URL_ROOT', '/');
define('DEFAULT_CONTROLLER', 'TaskController');
define('DEFAULT_ACTION', 'index');
define('APP_URL', getenv('APP_URL'));