<?php

define('BASE_DIR', dirname(__DIR__));
define('APP_DIR', BASE_DIR . '/src');

$loader = new \Phalcon\Loader();
// register an application namespace
$loader->registerNamespaces(['Application' => APP_DIR]);

$loader->register();

$bootstrap = new \Application\Bootstrap();
// create an application
$application = $bootstrap->createApplication();

// handle a request, then send the response
echo $application->handle()->getContent();