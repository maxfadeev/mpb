<?php


namespace Application\Modules\Admin;


use Phalcon\Loader;
use Phalcon\Mvc\ModuleDefinitionInterface;

class Module implements ModuleDefinitionInterface
{

    /**
     * Registers an autoloader related to the module
     */
    public function registerAutoloaders()
    {
        $loader = new Loader();

        $loader->registerNamespaces([
            'Application\Modules\Admin\Controllers' => '../application/modules/admin/controllers/',
            'Application\Modules\Admin\Models' => '../application/modules/admin/models/',
        ]);

        $loader->register();
    }

    /**
     * Registers services related to the module
     *
     * @param \Phalcon\DiInterface $di
     */
    public function registerServices($di)
    {
        // TODO: Implement registerServices() method.
    }
}