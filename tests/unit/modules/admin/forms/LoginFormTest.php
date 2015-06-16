<?php


namespace Tests\Unit\Modules\Admin\Forms;


use Application\Modules\Admin\Forms\LoginForm;

class LoginFormTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var LoginForm
     */
    protected $form;

    public function setUp()
    {
        $this->form = new LoginForm();
        $this->form->initialize();
    }

    public function testFormLoginElement()
    {
        $this->assertArrayHasKey('login', (array)$this->form->getElements());

        $login = $this->form->get('login');

        $this->assertEquals('Login', $login->getAttribute('placeholder'));
        $this->assertEquals(1, count($login->getValidators()));
        $this->assertInstanceOf('Phalcon\Validation\Validator\PresenceOf', $login->getValidators()[0]);
    }

    public function testFormPasswordElement()
    {
        $this->assertArrayHasKey('password', (array)$this->form->getElements());

        $login = $this->form->get('password');

        $this->assertEquals('Password', $login->getAttribute('placeholder'));
        $this->assertEquals(1, count($login->getValidators()));
        $this->assertInstanceOf('Phalcon\Validation\Validator\PresenceOf', $login->getValidators()[0]);
    }

    public function testFormSubmitElement()
    {
        $this->assertArrayHasKey('submit', (array)$this->form->getElements());

        $login = $this->form->get('submit');

        $this->assertEquals('Submit', $login->getAttribute('value'));
        $this->assertEquals('btn', $login->getAttribute('class'));
    }

    public function testFormIsValid()
    {
        $this->assertTrue($this->form->isValid([
            'login' => 'login1',
            'password' => 'password1'
        ]));
    }

    /**
     * @dataProvider provideInvalidData
     * @param string $login
     * @param string $password
     */
    public function testFormIsInvalid($login, $password)
    {
        $this->assertFalse($this->form->isValid([
            'login' => $login,
            'password' => $password
        ]));
    }

    public function provideInvalidData()
    {
        return [
            ['login' => '', 'password' => 'password1'],
            ['login' => 'login1', 'password' => ''],
            ['login' => '', 'password' => '']
        ];
    }
}