<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class AccountSetupForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('first_name', 'text')
            ->add('last_name', 'text')
            ->add('username', 'text')
            ->add('password', 'password')
            ->add('password_confirmation', 'password')
            ;
    }
}
