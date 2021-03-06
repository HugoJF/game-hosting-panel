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
        $this->add('description', 'textarea', $this->params('User friendly description'));
    }

    protected function params($text): array
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
