<?php


namespace Application;


use Application\Modules\Users\Models\Roles;
use Phalcon\Acl\Adapter\Memory;
use Phalcon\Acl\Resource;
use Phalcon\Acl\Role;
use Phalcon\Mvc\User\Component;

abstract class Acl extends Component
{
    /**
     * @var \Phalcon\Acl\Adapter\Memory
     */
    protected $acl;

    /**
     * The filepath of the ACL cache file from APP_DIR
     *
     * @var string
     */
    protected $filePath = '/cache/acl/data.txt';

    /**
     * Define the resources that are considered "private". These controller => actions require authentication.
     *
     * @var array
     */
    protected $privateResources = [];

    /**
     * Check if a resource(controller) is private or not
     *
     * @param string $resource
     * @return bool
     */
    public function isPrivate($resource)
    {
        return isset($this->privateResources[$resource]);
    }

    /**
     * Checks if the current role is allowed to access a resource
     *
     * @param string $role
     * @param string $resource
     * @param string $action
     * @return bool
     */
    public function isAllowed($role, $resource, $action)
    {
        return $this->getAcl()->isAllowed($role, $resource, $action);
    }

    /**
     * Gets the ACL object
     *
     * @return \Phalcon\Acl\Adapter\Memory
     */
    public function getAcl()
    {
        // check whether the ACL is already created
        if (is_object($this->acl)) {
            return $this->acl;
        }

        // check whether the ACL is in APC
        if (function_exists('apc_fetch')) {
            $acl = apc_fetch('acl-store');
            if (is_object($acl)) {
                $this->acl = $acl;
                return $acl;
            }
        }

        // check whether the ACL is already generated
        if (!file_exists(APP_DIR . $this->filePath)) {
            $this->acl = $this->rebuild();
            return $this->acl;
        }

        // get the ACL for serialized data
        $data = file_get_contents(APP_DIR . $this->filePath);
        $this->acl = unserialize($data);

        // store the ACL in APC
        if (function_exists('apc_store')) {
            apc_store('acl-store', $this->acl);
        }

        return $this->acl;
    }

    /**
     * Rebuilds the ACL object
     *
     * @return \Phalcon\Acl\Adapter\Memory
     */
    public function rebuild()
    {
        $acl = new Memory();

        $acl->setDefaultAction(\Phalcon\Acl::DENY);

        $roles = Roles::find();
        foreach ($roles as $role) {
            $acl->addRole(new Role($role->name));
        }

        foreach ($this->privateResources as $resource => $actions) {
            $acl->addResource(new Resource($resource), $actions);
        }

        foreach ($roles as $role) {
            $permissions = $role->getPermissions();
            foreach ($permissions as $permission) {
                $acl->allow($role->name, $permission->resource, $permission->action);
            }
        }

        if (touch(APP_DIR . $this->filePath) && is_writable(APP_DIR . $this->filePath)) {
            file_put_contents(APP_DIR . $this->filePath, serialize($acl));

            if (function_exists('apc_store')) {
                apc_store('acl-store', $acl);
            }
        } else {
            // error
        }

        return $acl;
    }
}