<?php


namespace Application;


use Phalcon\DI\FactoryDefault;
use Phalcon\Mvc\Url;
use Phalcon\Session\Adapter\Files as SessionAdapter;

class Di extends FactoryDefault
{
    public function __construct()
    {
        parent::__construct();

        $this->setSession();
        $this->setUrl();
    }

    /**
     * Sets a Session service
     */
    public function setSession()
    {
        $this->setShared('session', function() {
            $session = new SessionAdapter();
            $session->start();
            return $session;
        });
    }

    /**
     * Sets an Url service
     */
    public function setUrl()
    {
        $this->di->set('url', function() {
            $url = new Url();
            $url->setBaseUri('/');
            return $url;
        });
    }
}