<?php


namespace Application\Modules\Admin\Forms\Users;


use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Select;
use Phalcon\Validation\Validator\Confirmation;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\StringLength;

class EditForm extends AddForm
{
    const STATUS_ACTIVE = 1;
    const STATUS_SUSPENDED = 2;
    const STATUS_BANNED = 3;

    /**
     * Initializes form elements
     */
    public function initialize()
    {
        parent::initialize();

        $this->addStatusElement();
    }

    /**
     * Adds changePassword and confirm-changePassword inputs
     */
    public function addPasswordElement()
    {
        $password = new Password('changePassword');
        $password->setLabel('Change password');
        $password->addValidators([
            new PresenceOf(['message' => 'The password is required']),
            new StringLength([
                'min' => 8,
                'messageMinimum' => 'The password is too short. Minimum 8 characters'
            ]),
            new Confirmation([
                'message' => 'The password doesn\'t match confirmation',
                'with' => 'confirmChangePassword'
            ])
        ]);

        $this->add($password);

        $confirmPassword = new Password('confirmChangePassword');
        $confirmPassword->addValidator(new PresenceOf([
            'message' => 'The confirmation password is required'
        ]));

        $this->add($confirmPassword);
    }

    /**
     * Adds a status drip-down select
     */
    public function addStatusElement()
    {
        $role = new Select('status');
        $role->setLabel('Status');
        $role->setOptions([
            self::STATUS_ACTIVE => 'active',
            self::STATUS_SUSPENDED => 'suspended',
            self::STATUS_BANNED => 'banned'
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
        return $status == self::STATUS_ACTIVE;
    }

    /**
     * Checks if a status is 'suspended'
     *
     * @param integer $status
     * @return bool
     */
    public function isSuspended($status)
    {
        return $status == self::STATUS_SUSPENDED;
    }

    /**
     * Checks if a status is 'banned'
     *
     * @param integer $status
     * @return bool
     */
    public function isBanned($status)
    {
        return $status == self::STATUS_BANNED;
    }
}