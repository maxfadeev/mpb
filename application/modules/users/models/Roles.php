<?php


namespace Application\Modules\Users\Models;


use Phalcon\Mvc\Model;

class Roles extends Model
{
    /**
     * @var integer
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    public function initialize()
    {
        $this->hasMany('id', 'Application\Modules\Users\Models\Permissions', 'role_id');
    }
}