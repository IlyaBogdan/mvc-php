<?php

require_once dirname(__FILE__) . '/../config.php';

require_once dirname(__FILE__) . '/../kernel/Router.php';
require_once dirname(__FILE__) . '/../kernel/Controller.php';
require_once dirname(__FILE__) . '/../kernel/Model.php';
require_once dirname(__FILE__) . '/../kernel/View.php';
require_once dirname(__FILE__) . '/../kernel/Migration.php';

$router = new kernel\Router();
$router->dispatch($_SERVER['REQUEST_URI']);