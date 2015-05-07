<?php


namespace Application\Modules\Users\Components;


use Application\Modules\Users\Models\Roles;
use Phalcon\Acl\Adapter\Memory;
use Phalcon\Acl\Role;
use Phalcon\Mvc\User\Component;

class Acl extends Component
{
    /**
     * @var \Phalcon\Acl\Adapter\Memory
     */
    private $acl;

    private $privateResources = [
        'users' => [
            'add',
            'index'
        ]
    ];

    public function rebuild()
    {
        $acl = new Memory();

        $acl->setDefaultAction(\Phalcon\Acl::DENY);

        $roles = Roles::find();
        foreach ($roles as $role) {
            $acl->addRole(new Role($role->name));
        }
    }
}