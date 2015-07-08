<?php


namespace Application\Modules\Users\Components;


use Application\Acl as ApplicationAcl;

class Acl extends ApplicationAcl
{
    protected $privateResources = [
        'users' => [
            'add',
            'index'
        ]
    ];
}