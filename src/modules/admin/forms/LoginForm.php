<?php


namespace Application\Modules\Admin\Forms;


use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Submit;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Form;
use Phalcon\Validation\Validator\PresenceOf;

class LoginForm extends Form
{
    public function initialize()
    {
        $login = new Text('login', ['placeholder' => 'Login']);
        $login->addValidator(new PresenceOf(['message' => 'The login is required']));

        $this->add($login);

        $password = new Password('password', ['placeholder' => 'Password']);
        $password->addValidator(new PresenceOf(['message' => 'The password is required']));

        $this->add($password);

        $this->add(new Submit('submit', ['value' => 'Submit', 'class' => 'btn']));
    }
} 