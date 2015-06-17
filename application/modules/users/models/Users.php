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

    /**
     * Initializes the model
     */
    public function initialize()
    {
        // set values of these attributes by default
        $this->skipAttributesOnCreate(['banned', 'suspended', 'active']);

        $this->hasMany('id', 'Application\Modules\Articles\Models\Articles', 'uid', [
            'alias' => 'articles'
        ]);
    }

    /**
     * @param int $id, the id of the user to be found
     * @return \Phalcon\Mvc\Model
     */
    public static function findFirstById($id)
    {
        return parent::findFirstById((int) $id);
    }
} 