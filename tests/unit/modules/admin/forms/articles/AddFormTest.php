<?php


namespace Tests\Unit\Modules\Admin\Forms\Articles;


use Application\Modules\Admin\Forms\Articles\AddForm;

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

    public function testFormTitleElement()
    {
        $this->assertArrayHasKey('title', (array)$this->form->getElements());

        $title = $this->form->get('title');

        $this->assertEquals('Title', $title->getLabel());
        $this->assertEquals(1, count($title->getValidators()));

        $validator = $title->getValidators()[0];
        $this->assertInstanceOf('Phalcon\Validation\Validator\PresenceOf', $validator);
        $this->assertEquals('The title is required', $validator->getOption('message'));
    }

    public function testFormTextElement()
    {
        $this->assertArrayHasKey('text', (array)$this->form->getElements());

        $text = $this->form->get('text');

        $this->assertEquals('Text', $text->getLabel());
    }
}