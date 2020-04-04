<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class CouponForm extends Form
{
	public function buildForm()
	{
		$this->code();
		$this->value();
		$this->maxUses();
	}

	protected function code(): void
	{
		$this->add('code', 'text');
	}

	protected function value(): void
	{
		$this->add('value', 'number');
	}

	protected function maxUses(): void
	{
		$this->add('max_uses', 'number');
	}
}
