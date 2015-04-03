<?php


namespace Application;


use Phalcon\Config\Adapter\Ini;
use Phalcon\Mvc\Application;

class Bootstrap
{
    /**
     * @var \Phalcon\DI
     */
    protected $di;

    public function __construct()
    {
        $this->di = new DiApplication();
    }

    /**
     * Creates an Application instance and calls registerModules()
     *
     * @return \Phalcon\Mvc\Application
     */
    public function createApplication()
    {
        $application = new Application($this->di);

        $this->registerModules($application);

        return $application;
    }

    /**
     * Registers modules
     *
     * @param \Phalcon\Mvc\Application$application
     */
    public function registerModules(Application $application)
    {
        $application->registerModules($this->getIniConfiguration('modules')->toArray());
    }

    /**
     * Gets concrete Ini configuration instance by name
     *
     * @param string $name
     * @return \Phalcon\Config\Adapter\Ini
     */
    public function getIniConfiguration($name)
    {
        return new Ini("../application/configs/{$name}.ini");
    }

}