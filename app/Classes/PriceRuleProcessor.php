<?php
/**
 * Created by PhpStorm.
 * User: Hugo
 * Date: 8/1/2019
 * Time: 7:50 AM
 */

namespace App\Classes;

class PriceRuleProcessor
{
	protected $operations = [
		'+' => 'opSum',
		'-' => 'opSub',
		'*' => 'opMult',
		'/' => 'opDiv',
	];

	const OPERATIONS_SEPARATOR = ';';
	const OPERATION_SEPARATOR = ':';
	const ARROW_SELECTOR = '=>';

	protected $values = [];
	protected $rawRules = '';

	public function setRule($rule)
	{
		$this->rawRules = $rule;

		return $this;
	}

	public function setValues(array $values)
	{
		$this->values = array_merge($this->values, $values);

		return $this;
	}

	public function run()
	{
		// Split rules
		$rules = collect(preg_split($this->reg(self::OPERATIONS_SEPARATOR), $this->rawRules));

		// Split each rule name/definition
		$operations = $rules->map(function ($rule) {
			$parts = preg_split($this->reg(self::OPERATION_SEPARATOR), $rule);

			if (count($parts) > 2)
				throw new \Exception('Malformed rule: ' . $rule);

			return $parts;
		});

		// Map rules to values
		$firstPass = $operations->map(function ($operation) {
			// This is an operator, don't translate it
			if (count($operation) === 1)
				return $operation[0];

			return $this->runRule($operation);
		});

		// Run math operations
		$result = null;
		for ($i = 0; $i < count($firstPass); $i++) {
			$op = $firstPass[ $i ];

			// Fill first value
			if ($i === 0) {
				$result = $op;
				continue;
			}

			// Run operation
			if (array_key_exists($op, $this->operations)) {
				$func = $this->operations[ $op ];

				$result = call_user_func_array([$this, $func], [$result, $firstPass[ ++$i ]]);
			} else {
				throw new \Exception('Invalid operator: ' . $op);
			}
		}

		return $result;
	}

	public function runRule($operation)
	{
		// Destructuring operation
		list($name, $definition) = $operation;

		// Retrieve information by it's name
		$value = $this->values[ $name ];

		// Check if rule is a selector or simple number
		$isSelector = strpos($definition, self::ARROW_SELECTOR);

		// Run rule
		if ($isSelector) {
			return $this->runSelector($definition, $value);
		} else {
			return $this->runNumber($definition, $value);
		}
	}

	public function runSelector($definition, $key)
	{
		// Split each value selector
		$kvs = collect(preg_split('/,/', $definition));

		// Split and map selector key and values
		$kvs = $kvs->mapWithKeys(function ($kv) {
			$parts = preg_split('/=>/', $kv);

			return [$parts[0] => $parts[1]];
		});

		// Return valued selected by $key
		return $kvs->get($key, 0);
	}

	public function runNumber($definition, $value)
	{
		return $definition * $value;
	}

	protected function opSum($total, $number)
	{
		return $total + $number;
	}

	protected function opSub($total, $number)
	{
		return $total - $number;
	}

	protected function opMult($total, $number)
	{
		return $total * $number;
	}

	protected function opDiv($total, $number)
	{
		return $total / $number;
	}

	protected function reg($preg)
	{
		return "/$preg/";
	}
}