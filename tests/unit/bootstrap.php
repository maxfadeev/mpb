<?php

define('BASE_DIR', dirname(dirname(__DIR__)));
define('APP_DIR', BASE_DIR . '/src');

require BASE_DIR . '/vendor/autoload.php';

$loader = new \Phalcon\Loader();

// register the application namespaces
$loader->registerNamespaces([
    'Application' => APP_DIR . '/'
]);

$loader->register();

$config = new \Phalcon\Config\Adapter\Ini(APP_DIR . "/configs/application.ini");

$di = new \Phalcon\Di\FactoryDefault();

$connection = new \Phalcon\Db\Adapter\Pdo\Sqlite(['dbname' => ':memory:']);
$connection->execute(file_get_contents(BASE_DIR . '/data/sqlite_dump.sql'));

$di->set('db', $connection);
