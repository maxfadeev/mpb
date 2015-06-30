<?php

define('BASE_DIR', dirname(dirname(__DIR__)));
define('APP_DIR', BASE_DIR . '/application');

require BASE_DIR . '/vendor/autoload.php';

$loader = new \Phalcon\Loader();

// register the application namespaces
$loader->registerNamespaces([
    'Application' => APP_DIR . '/',
    'Application\Modules\Admin' => APP_DIR . '/modules/admin/',
    'Application\Modules\Admin\Components' => APP_DIR . '/modules/admin/components'
]);

$loader->register();

$config = new \Phalcon\Config\Adapter\Ini(APP_DIR . "/configs/application.ini");

$di = new \Phalcon\Di\FactoryDefault();

$di->setShared('db', [
    'className' => 'Phalcon\Db\Adapter\Pdo\Mysql',
    'arguments' => [
        [
            'type' => 'parameter',
            'value' => [
                'host' => '192.168.56.102',
                'username' => $config->db->username,
                'password' => $config->db->password,
                'dbname' => $config->db->name
            ]
        ]
    ]
]);