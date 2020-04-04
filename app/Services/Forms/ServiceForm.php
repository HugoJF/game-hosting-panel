<?php
/**
 * Created by PhpStorm.
 * User: Hugo
 * Date: 7/22/2019
 * Time: 1:26 AM
 */

namespace App\Services\Forms;

use Kris\LaravelFormBuilder\FormBuilder;

class ServiceForm
{
	protected $formBuilder;

	public function __construct(FormBuilder $formBuilder)
	{
		$this->formBuilder = $formBuilder;
	}

}