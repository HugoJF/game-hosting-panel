<?php
/**
 * Created by PhpStorm.
 * User: Hugo
 * Date: 7/26/2019
 * Time: 1:45 AM
 */

namespace App\Traits;

trait DynamicForm
{
	protected function buildDeployForm($config)
	{
		foreach ($config as $name => $parameter) {
			$this->buildField($name, $parameter);
		}
	}

	protected function buildField($name, $parameter)
	{
		$this->add($name, $parameter['type'], $parameter['options'] ?? []);
	}
}