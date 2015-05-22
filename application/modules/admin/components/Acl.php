<?php


namespace Application\Modules\Admin\Components;


use Application\Acl as ApplicationAcl;

class Acl extends ApplicationAcl
{
    /**
     * Define the resources that are considered "private". These controller => actions require authentication.
     *
     * @var array
     */
    protected $privateResources = [
        'users' => [
            'index',
            'add',
            'delete',
            'edit'
        ],
        'articles' => [
            'index',
            'add',
            'delete',
            'edit'
        ],
        'index' => [
            'index'
        ]
    ];
}