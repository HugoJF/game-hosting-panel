<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class AnnoucementForm extends Form
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

    protected function visible()
    {
        $this->add('visible', 'checkbox');
    }

    public function type()
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

    protected function action()
    {
        $this->add('action', 'text');
    }

    protected function actionUrl()
    {
        $this->add('action_url', 'text');
    }

    protected function expiresAt()
    {
        $this->add('expires_at', 'datetimepicker');
    }
}
