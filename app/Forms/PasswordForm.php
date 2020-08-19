<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class PasswordForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('password', 'password')
            ->add('password_confirmation', 'password')
            ;
    }
}
