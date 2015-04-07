<?php


namespace Application\Modules\Admin\Forms;


use Phalcon\Forms\Element\Submit;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Form;
use Phalcon\Validation\Validator\PresenceOf;

class LoginForm extends Form
{
    public function initialize()
    {
        $login = new Text('login', ['placeholder' => 'Login']);
        $login->addValidator(new PresenceOf(['message' => 'The login os required']));

        $this->add($login);

        $password = new Text('password', ['placeholder' => 'Password']);
        $password->addValidator(new PresenceOf(['message' => 'The password is required']));

        $this->add($password);

        $this->add(new Submit('submit', ['class' => 'btn']));
    }
} 