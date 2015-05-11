<?php

define('BASE_DIR', dirname(dirname(__DIR__)));
define('APP_DIR', BASE_DIR . '/application');

$loader = new \Phalcon\Loader();
// register an application namespace
$loader->registerNamespaces(['Application' => BASE_DIR. '/application']);

$loader->register();