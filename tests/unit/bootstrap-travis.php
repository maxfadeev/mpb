<?php

define('BASE_DIR', dirname(dirname(__DIR__)));
define('APP_DIR', BASE_DIR . '/application');

require BASE_DIR . '/vendor/autoload.php';

$loader = new \Phalcon\Loader();

// register the application namespaces
$loader->registerNamespaces([
    'Application' => APP_DIR . '/',
    'Application\Modules\Admin' => APP_DIR . '/modules/admin/',
    'Application\Modules\Admin\Components' => APP_DIR . '/modules/admin/components',
    'Application\Modules\Admin\Models' => APP_DIR . '/modules/admin/models',
    'Application\Modules\Admin\Controllers' => APP_DIR . '/modules/admin/controllers',
    'Application\Modules\Admin\Forms' => APP_DIR . '/modules/admin/forms',
    'Application\Modules\Admin\Forms\Articles' => APP_DIR . '/modules/admin/forms/articles',
    'Application\Modules\Admin\Forms\Users' => APP_DIR . '/modules/admin/forms/users',
    'Application\Modules\Users\Models' => APP_DIR . '/modules/users/models',
    'Application\Modules\Users\Components' => APP_DIR . '/modules/users/components'
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
                'host' => '127.0.0.1',
                'username' => 'travis',
                'dbname' => $config->db->name
            ]
        ]
    ]
]);