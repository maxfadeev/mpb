<?php


namespace Application\Modules\Users\Models;


use Phalcon\Mvc\Model;

class FailedLogins extends Model
{
    /**
     * @var integer
     */
    public $id;

    /**
     * @var integer
     */
    public $uid;

    /**
     * @var string
     */
    public $ip;

    /**
     * @var integer
     */
    public $attempted;
}