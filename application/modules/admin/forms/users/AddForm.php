<?php


namespace Application\Modules\Admin\Forms\Users;


use Phalcon\Mvc\Model\ResultsetInterface;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Element\Submit;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Form;
use Phalcon\Validation\Validator\Confirmation;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\StringLength;

class AddForm extends Form
{
    /**
     * Initializes form elements
     */
    public function initialize()
    {
        // login
        $this->addLoginElement();
        // email
        $this->addEmailElement();
        // password & password confirm
        $this->addPasswordElement();

        $this->add(new Hidden('csrf'));

        $this->add(new Submit('submit', ['value' => 'Submit', 'class' => 'btn']));
    }

    /**
     * Adds a login input
     */
    public function addLoginElement()
    {
        $login = new Text('login');
        $login->addValidators([
            new PresenceOf(['message' => 'The login is required']),
            new StringLength([
                'max' => 20,
                'min' => 3,
                'messageMaximum' => 'The name is too long. Maximum 20 characters',
                'messageMinimum' => 'The name is too short. Minimum 3 characters'
            ])
        ]);

        $this->add($login);
    }

    /**
     * Adds an email input
     */
    public function addEmailElement()
    {
        $email = new Text('email');
        $email->addValidators([
            new PresenceOf(['message' => 'The email is required']),
            new Email(['message' => 'The email is not valid'])
        ]);

        $this->add($email);
    }

    /**
     * Adds password and confirm-password inputs
     */
    public function addPasswordElement()
    {
        $password = new Password('password');
        $password->addValidators([
            new PresenceOf(['message' => 'The password is required']),
            new StringLength([
                'min' => 8,
                'messageMinimum' => 'The password is too short. Minimum 8 characters'
            ]),
            new Confirmation([
                'message' => 'The password doesn\'t match confirmation',
                'with' => 'confirmPassword'
            ])
        ]);

        $this->add($password);

        $confirmPassword = new Password('confirmPassword');
        $confirmPassword->addValidator(new PresenceOf([
            'message' => 'The confirmation password is required'
        ]));

        $this->add($confirmPassword);
    }

    /**
     * Adds a role drop-down select
     *
     * @param \Phalcon\Mvc\Model\ResultsetInterface $roles
     */
    public function addRoleElement(ResultsetInterface $roles)
    {
        $role = new Select('role');
        $role->setOptions($roles);
        $role->setAttributes(['using' => ['id', 'name']]);

        $this->add($role);
    }

    /**
     * Prints messages for a specific element
     *
     * @param string $name
     */
    public function messages($name)
    {
        if ($this->hasMessagesFor($name)) {
            foreach ($this->getMessagesFor($name) as $message) {
                $this->flash->error($message);
            }
        }
    }
}