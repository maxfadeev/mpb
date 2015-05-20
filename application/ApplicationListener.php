<?php


namespace Application;


use Phalcon\Events\Event;
use Phalcon\Mvc\User\Component;

/**
 * @property \Phalcon\Logger\Adapter\File logger
 */
class ApplicationListener extends Component
{
    /**
     * Handles when the application handles its first request
     */
    public function boot()
    {
        $this->logger->begin();
        $this->logger->info("Starting application...");
    }

    /**
     * Handles after initialize a module, only when modules are registered
     */
    public function afterStartModule()
    {
        $this->logger->commit();
    }
}