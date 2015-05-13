<?php

define('BASE_DIR', dirname(dirname(__DIR__)));
define('APP_DIR', BASE_DIR . '/application');

require BASE_DIR . '/vendor/autoload.php';

$loader = new \Phalcon\Loader();
// register an application namespace
$loader->registerNamespaces(['Application' => APP_DIR]);

$loader->register();