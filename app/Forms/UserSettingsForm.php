<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class UserSettingsForm extends Form
{
    public function buildForm()
    {
        $this->add('email', 'text', $this->params('Email to send notifications.'));
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
