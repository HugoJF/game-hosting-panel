<?php
/**
 * Created by PhpStorm.
 * User: Hugo
 * Date: 7/26/2019
 * Time: 1:45 AM
 */

namespace App\Traits;

trait PresetSettings
{
	protected function fill($settings, $values)
	{
		foreach ($settings as $key => $setting) {
			$field = $this->getField($key);
			if (!$field)
				continue;
			if (!array_key_exists($key, $values))
				continue;

			$value = $values[ $key ];
			$field->setValue($value);
		}
	}
}