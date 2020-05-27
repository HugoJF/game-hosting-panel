<?php

namespace App\Classes;

use c;
use Exception;
use phpDocumentor\Reflection\Types\Collection;

abstract class SpecCalculator
{
    protected $params;

    abstract function cost($parameters): array;

    abstract function reject($cost): bool;

    public function calculate(array $choices)
    {
        // Filter choices that was used in this calculator
        $usedChoices = collect($choices)->only($this->params)->toArray();

        // Map 'empty_value' for each parameter
        $defaultChoices = collect($this->params)->mapWithKeys(function ($param) {
            return [$param => $this->$param['empty_value']];
        })->toArray();

        // Add default values to missing choices
        $choices = array_merge($defaultChoices, $usedChoices);

        return collect($this->params)->mapWithKeys(function ($param) use ($choices) {
            return [$param => $this->buildVariations($param, $choices)];
        });
    }

    private function buildVariations(string $param, array $choices): array
    {
        if (!array_key_exists('options', $this->$param)) {
            throw new Exception("Could not find 'options' definition for parameter $param");
        }

        return collect($this->$param['options'])->mapWithKeys(function ($option) use ($param, $choices) {
            // Merge current 'choices' with each 'option' for current 'parameter'
            $newChoices = array_merge($choices, [
                $param => $option,
            ]);

            // Map 'option' to the 'cost' of this set of parameters
            return [$option => $this->cost($newChoices)];
        })->reject(function ($cost) {
            return $this->reject($cost);
        })->toArray();
    }
}
