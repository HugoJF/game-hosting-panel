<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class UserSettingsForm extends Form
{
    public function buildForm()
    {
        $choices = collect(config('localization.locales'))
            ->map(fn($details) => $details['language_key'])
            ->map(fn($key) => trans($key))
            ->toArray();


        $this->add('locale', 'select', array_merge(
            $this->params('Email to send notifications.'),
            compact('choices')
        ));
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
