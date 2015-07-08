<?php


namespace Application\Modules\Users\Models;


use Phalcon\Mvc\Model;

class SuccessLogins extends Model
{
    /**
     * @var integer
     */
    public $uid;

    /**
     * @var string
     */
    public $ip;

    /**
     * @var string
     */
    public $user_agent;
}