<?php

namespace App\Forms;

use App\Location;
use Kris\LaravelFormBuilder\Form;

class NodeTypeSelectionForm extends Form
{
	public function buildForm()
	{
		$this->type();
	}

	protected function type(): void
	{
		$this->add('type', 'select', [
			'choices'     => $this->getData('types'),
			'empty_value' => '=== Select node type ===',
		]);
	}

}
