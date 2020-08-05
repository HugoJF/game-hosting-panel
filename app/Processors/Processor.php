<?php

namespace App\Processors;

use App\Node;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

abstract class Processor
{
    protected array $params = [];
    protected Node $node;

    /**
     * Calculates resources cost for a given config
     *
     * @param array $config
     *
     * @return array
     */
    abstract protected function cost(array $config): array;

    /**
     * Generates rules needed to compute cost
     *
     * @return array
     */
    abstract protected function rules(): array;

    /**
     * Sets the Node used as reference to reject resource costs
     *
     * @param Node $node
     *
     * @return Processor
     */
    public function setNode(Node $node): Processor
    {
        return tap($this, fn() => $this->node = $node);
    }

    /**
     * Validates config then compute cost
     *
     * @param array $config
     *
     * @return array
     */
    public function resourceCost(array $config): array
    {
        try {
            Validator::validate($config, $this->rules());

            return $this->cost($config);
        } catch (ValidationException $e) {
            return collect(['cpu', 'memory', 'disk', 'databases'])
                ->flip()
                ->map(fn() => 0)
                ->toArray();
        }
    }

    /**
     * Calculates resource usage for a given server configuration choice.
     *
     * @param array $choices
     *
     * @return array
     */
    public function calculate(array $choices): array
    {
        // Filter choices that was used in this calculator
        $usedChoices = collect($choices)->only(array_keys($this->params))->toArray();

        // Map 'empty_value' for each parameter
        $defaultChoices = collect($this->params)->mapWithKeys(fn($value, $param) => [
            $param => $this->params[ $param ]['empty_value']]
        )->toArray();

        // Add default values to missing choices
        $choices = array_merge($defaultChoices, $usedChoices);

        // Map possible parameter variables (that are compatible with the current choices)
        $options = collect($this->params)->mapWithKeys(fn($value, $param) => [
            $param => $this->possibleVariables($param, $choices),
        ])->toArray();

        // Replace possible choices into parameter list
        return collect($this->params)->mapWithKeys(fn($definition, $param) => [
            $param => array_merge(
                $definition,
                [
                    'options' => $options[ $param ],
                ],
            ),
        ])->toArray();
    }

    /**
     * Given a parameter name, variate all it's options against a configuration and filter configurations
     * that are get rejected by reject()
     *
     * @param string $param
     * @param array  $choices
     *
     * @return array
     * @throws Exception
     */
    private function possibleVariables(string $param, array $choices): array
    {
        // Assert that the parameter is defined
        if (!array_key_exists('options', $this->params[ $param ])) {
            throw new Exception("Could not find 'options' definition for parameter $param");
        }

        $options = $this->params[ $param ]['options'];

        // Build a config for each parameter option and current choices, calculate cost and filter results.
        return collect($options)
            ->mapWithKeys(fn($text, $option) => [
                $option => array_merge($choices, [$param => $option]),
            ])
            // Compute resource cost for each config
            ->map(fn($config) => $this->resourceCost($config))
            // Remove configs that have their resource cost rejected
            ->reject(fn($cost) => $this->reject($cost))
            // Options that were not rejected
            ->keys()
            // Map option key to option text
            ->mapWithKeys(fn($option) => [$option => $options[ $option ]])
            ->toArray();
    }

    /**
     * Checks if resource cost is invalid
     *
     * @param array $resourceCost
     *
     * @return bool
     */
    public function reject(array $resourceCost): bool
    {
        $limits = [
            'cpu'       => 'cpu_limit',
            'memory'    => 'memory_limit',
            'disk'      => 'disk_limit',
            'databases' => 'database_limit',
        ];

        foreach ($limits as $resource => $limit) {
            $cost = $resourceCost[ $resource ];

            if ($cost > $limit) {
                return false;
            }
        }
    }
}
