<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class AnnouncementForm extends Form
{
    public function buildForm()
    {
        $this->visible();
        $this->type();
        $this->description();
        $this->action();
        $this->actionUrl();
        $this->expiresAt();
    }

    protected function visible(): void
    {
        $this->add('visible', 'checkbox');
    }

    public function type(): void
    {
        $this->add('type', 'select', [
            'choices' => [
                'success' => 'Success',
                'danger'  => 'Danger',
            ],
        ]);
    }

    protected function description(): void
    {
        $this->add('description', 'text');
    }

    protected function action(): void
    {
        $this->add('action', 'text');
    }

    protected function actionUrl(): void
    {
        $this->add('action_url', 'text');
    }

    protected function expiresAt(): void
    {
        $this->add('expires_at', 'datetimepicker');
    }
}
