<?php

namespace App\Forms;

use App\Notifications\ServerDeployed;
use App\Notifications\TransactionUpdated;
use App\User;
use Kris\LaravelFormBuilder\Form;

class UserSettingsForm extends Form
{
    public function buildForm()
    {
        $this->locale();

        $this->_notification(
            TransactionUpdated::class,
            'Transaction updated notifications',
            'Enable notifications when a transaction is updated.'
        );

        $this->_notification(
            ServerDeployed::class,
            'Server deployed notifications',
            'Enable notifications when a server is deployed.'
        );
    }

    protected function locale(): void
    {
        $choices = collect(config('localization.locales'))
            ->map(fn($details) => $details['language_key'])
            ->map(fn($key) => trans($key))
            ->toArray();

        $this->add('locale', 'select', array_merge(
            $this->_params('Email to send notifications.'),
            compact('choices')
        ));
    }

    protected function _notification(
        string $notificationClass,
        string $label,
        string $description
    ): void {
        /** @var User $user */
        $user = $this->getData('user');
        $setting = config("notifications.$notificationClass.setting");

        $this->add($setting, 'checkbox', array_merge(
            $this->_params($description),
            compact('label'),
            [
                'checked' => $user->settings()->get($setting),
            ]
        ));
    }

    protected function _params($text): array
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
