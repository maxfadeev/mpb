<?php


namespace Tests\Unit\Modules\Admin\Forms\Users;


use Application\Modules\Admin\Forms\Users\AddForm;

class AddFormTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var AddForm
     */
    protected $form;

    public function setUp()
    {
        $this->form = new AddForm();
        $this->form->initialize();
    }

    public function testFormLoginElement()
    {
        $this->assertArrayHasKey('login', (array)$this->form->getElements());

        $login = $this->form->get('login');

        $this->assertEquals('Login', $login->getLabel());
        $this->assertEquals(2, count($login->getValidators()));

        $validator = $login->getValidators()[0];
        $this->assertInstanceOf('Phalcon\Validation\Validator\PresenceOf', $validator);
        $this->assertEquals('The login is required', $validator->getOption('message'));

        $validator = $login->getValidators()[1];
        $this->assertInstanceOf('Phalcon\Validation\Validator\StringLength', $validator);
        $this->assertEquals(20, $validator->getOption('max'));
        $this->assertEquals(3, $validator->getOption('min'));
        $this->assertEquals('The name is too long. Maximum 20 characters', $validator->getOption('messageMaximum'));
        $this->assertEquals('The name is too short. Minimum 3 characters', $validator->getOption('messageMinimum'));
    }

    public function testFormEmailElement()
    {
        $this->assertArrayHasKey('email', (array)$this->form->getElements());

        $email = $this->form->get('email');

        $this->assertEquals('Email', $email->getLabel());
        $this->assertEquals(2, count($email->getValidators()));

        $validator = $email->getValidators()[0];
        $this->assertInstanceOf('Phalcon\Validation\Validator\PresenceOf', $validator);
        $this->assertEquals('The email is required', $validator->getOption('message'));

        $validator = $email->getValidators()[1];
        $this->assertInstanceOf('Phalcon\Validation\Validator\Email', $validator);
        $this->assertEquals('The email is not valid', $validator->getOption('message'));
    }

    public function testFormPasswordElement()
    {
        $this->assertArrayHasKey('password', (array)$this->form->getElements());

        $password = $this->form->get('password');

        $this->assertEquals('Password', $password->getLabel());
        $this->assertEquals(3, count($password->getValidators()));

        $validator = $password->getValidators()[0];
        $this->assertInstanceOf('Phalcon\Validation\Validator\PresenceOf', $validator);
        $this->assertEquals('The password is required', $validator->getOption('message'));

        $validator = $password->getValidators()[1];
        $this->assertInstanceOf('Phalcon\Validation\Validator\StringLength', $validator);
        $this->assertEquals(8, $validator->getOption('min'));
        $this->assertEquals('The password is too short. Minimum 8 characters', $validator->getOption('messageMinimum'));

        $validator = $password->getValidators()[2];
        $this->assertInstanceOf('Phalcon\Validation\Validator\Confirmation', $validator);
        $this->assertEquals('The password doesn\'t match confirmation', $validator->getOption('message'));
        $this->assertEquals('confirmPassword', $validator->getOption('with'));
    }

    public function testFormConfirmPasswordElement()
    {
        $this->assertArrayHasKey('confirmPassword', (array)$this->form->getElements());
    }
}