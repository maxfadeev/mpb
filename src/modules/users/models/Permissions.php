<?php


namespace Application\Modules\Users\Models;


use Phalcon\Mvc\Model;

class Permissions extends Model
{
    /**
     * @var integer
     */
    public $id;

    /**
     * @var integer
     */
    public $role_id;

    /**
     * @var string
     */
    public $resource;

    /**
     * @var string
     */
    public $action;

    public function initialize()
    {
        $this->belongsTo('role_id', 'Application\Modules\Users\Models\Roles', 'id');
    }
}