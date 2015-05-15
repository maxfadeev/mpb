<?php


namespace Application\Modules\Users\Models;


use Phalcon\Mvc\Model;

class Users extends Model
{
    /**
     * @var integer
     */
    public $id;

    /**
     * @var string
     */
    public $login;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $password;

    /**
     * @var string
     */
    public $role;

    /**
     * @var boolean
     */
    public $banned;

    /**
     * @var boolean
     */
    public $suspended;

    /**
     * @var boolean
     */
    public $active;
} 