<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class ApiKeyForm extends Form
{
    public function buildForm()
    {
		$this->description();
	}

	protected function description(): void
	{
		$this->add('description', 'text');
	}
}
