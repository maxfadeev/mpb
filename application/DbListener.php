<?php


namespace Application;


use Phalcon\Db\Adapter\Pdo\Mysql;
use Phalcon\Db\Profiler;
use Phalcon\Events\Event;
use Phalcon\Mvc\User\Component;

/**
 * @property \Phalcon\Logger\Adapter\File logger
 */
class DbListener extends Component
{
    /**
     * @var \Phalcon\Db\Profiler
     */
    protected $profiler;

    /**
     * Handles before a SQL statement is sent to the database system
     *
     * @param \Phalcon\Events\Event $event
     * @param \Phalcon\Db\Adapter\Pdo\Mysql $connection
     */
    public function beforeQuery(Event $event, Mysql $connection)
    {
        $this->profiler = new Profiler();
        $this->profiler->startProfile($connection->getSQLStatement());

    }

    /**
     * Handles after a SQL statement is sent to database system
     *
     * @param \Phalcon\Events\Event $event
     * @param \Phalcon\Db\Adapter\Pdo\Mysql $connection
     */
    public function afterQuery(Event $event, Mysql $connection)
    {
        $this->profiler->stopProfile();
        $profiles = $this->profiler->getProfiles();
        foreach ($profiles as $profile) {
            $this->logger->debug("SQL Statement: " . $profile->getSqlStatement());
            $this->logger->debug("Start Time: " . $profile->getInitialTime());
            $this->logger->debug("Final Time: " . $profile->getFinalTime());
            $this->logger->debug("Total Elapsed Time: " . $profile->getTotalElapsedSeconds());
        }
    }
}