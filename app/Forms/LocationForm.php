<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class LocationForm extends Form
{
    public function buildForm()
    {
        $this->add('short', 'text', $this->params('Short description of location'));
        $this->add('long', 'text', $this->params('Long description of location'));
        $this->add('flag', 'text', $this->params('Flag ID for location'));
    }

    protected function params($text)
    {
        return [
            'help_block' => [
                'text' => $text,
                'tag'  => 'small',
                'attr' => ['class' => 'form-text text-muted'],
            ],
        ];
    }
}
