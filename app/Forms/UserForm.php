<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class UserForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('name', 'text')
            ->add('server_limit', 'number')
            ->add('server_expiration_days', 'number')
            ->add('email', 'text');
    }
}
