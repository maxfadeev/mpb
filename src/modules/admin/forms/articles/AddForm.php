<?php


namespace Application\Modules\Admin\Forms\Articles;


use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Submit;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Form;
use Phalcon\Validation\Validator\PresenceOf;

class AddForm extends Form
{
    /**
     * Initializes form elements
     */
    public function initialize()
    {
        // title
        $this->addTitleElement();
        //text
        $this->addTextElement();

        $this->add(new Hidden('csrf'));

        $this->add(new Submit('submit', ['value' => 'Submit', 'class' => 'btn']));
    }

    /**
     * Adds a title input
     */
    public function addTitleElement()
    {
        $title = (new Text('title'))
            ->setLabel('Title')
            ->addValidators([
                new PresenceOf(['message' => 'The title is required'])
            ]);

        $this->add($title);
    }

    /**
     * Adds a text area
     */
    public function addTextElement()
    {
        $text = (new TextArea('text'))
            ->setLabel('Text');

        $this->add($text);
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