<?php

namespace App\Traits;

trait FormSetDisabled
{
	/**
	 * @param $name
	 * @param $value
	 */
	public function setDisabled($name, $value = true)
	{
		$field = $this->getField($name);
		$opts = $field->getOption('attr');
		$new = [$value === true ? 'disabled' : ''];

		$field->setOption('attr', array_merge($opts, $new));
	}
}