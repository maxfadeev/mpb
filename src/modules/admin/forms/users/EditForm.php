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
        $password = (new Password('changePassword'))
            ->setLabel('Change password');
        $this->add($password);

        $this->add(new Password('confirmChangePassword'));
    }

    public function setPasswordValidators()
    {
        $this->get('changePassword')->addValidators([
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

    }

    /**
     * Adds a status drip-down select
     */
    public function addStatusElement()
    {
        $status = (new Select('status'))
            ->setOptions([
                self::STATUS_ACTIVE => self::STATUS_ACTIVE_NAME,
                self::STATUS_SUSPENDED => self::STATUS_SUSPENDED_NAME,
                self::STATUS_BANNED => self::STATUS_BANNED_NAME
            ])->setLabel('Status');

        $this->add($status);
    }

    /**
     * Checks if a value of status form element(chooser) is 'active'.
     * Actually, it is relevant when a request is POST and has a value of the status selector. Otherwise
     * this function returns null.
     *
     * @return boolean
     */
    public function isActive()
    {
        return (int) $this->getValue('status') === self::STATUS_ACTIVE;
    }

    /**
     * Checks if a value of status form element(chooser) is 'suspended'
     * Actually, it is relevant when a request is POST and has a value of the status selector. Otherwise
     * this function returns null.
     *
     * @return boolean
     */
    public function isSuspended()
    {
        return (int) $this->getValue('status') === self::STATUS_SUSPENDED;
    }

    /**
     * Checks if a value of status form element(chooser) is 'banned'
     * Actually, it is relevant when a request is POST and has a value of the status selector. Otherwise
     * this function returns null.
     *
     * @return boolean
     */
    public function isBanned()
    {
        return (int) $this->getValue('status') === self::STATUS_BANNED;
    }
}