<?php


namespace Application\Modules\Admin\Forms\Users;


use Phalcon\Forms\Element\Select;

class EditForm extends AddForm
{
    const ACTIVE = 1;
    const SUSPENDED = 2;
    const BANNED = 3;

    /**
     * Initializes form elements
     */
    public function initialize()
    {
        parent::initialize();

        $this->addStatusElement();
    }

    /**
     * Adds a status drip-down select
     */
    public function addStatusElement()
    {
        $role = new Select('status');
        $role->setOptions([
            self::ACTIVE => 'active',
            self::SUSPENDED => 'suspended',
            self::BANNED => 'banned'
        ]);

        $this->add($role);
    }

    /**
     * Checks if a status is 'active'
     *
     * @param integer $status
     * @return bool
     */
    public function isActive($status)
    {
        return $status == self::ACTIVE;
    }

    /**
     * Checks if a status is 'suspended'
     *
     * @param integer $status
     * @return bool
     */
    public function isSuspended($status)
    {
        return $status == self::SUSPENDED;
    }

    /**
     * Checks if a status is 'banned'
     *
     * @param integer $status
     * @return bool
     */
    public function isBanned($status)
    {
        return $status == self::BANNED;
    }
}