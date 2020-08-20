<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class InviteForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('email', 'text')
            ->add('funds', 'number');
    }
}
