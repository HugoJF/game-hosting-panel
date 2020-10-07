<?php

namespace App\Processors;

use App\Exceptions\InvalidParameterChoiceException;
use App\Exceptions\MissingStubException;
use App\Node;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

abstract class Processor
{
    protected array $parameters = [];

    protected string $stub;

    protected Node $node;

    /**
     * Calculates resources cost for a given config
     *
     * @param array $config
     *
     * @return array
     */
    abstract protected function calculateResourceCost(array $config): array;

    public function __construct()
    {
        $this->stub = collect(config('processors'))
            ->map(fn($definition) => $definition['handler'])
            ->flip()
            ->get(static::class);

        if ($this->stub === null) {
            throw new MissingStubException;
        }

        $this->parameters = config("processors.$this->stub.parameters");
    }

    /**
     * Generates rules needed to compute cost
     *
     * @return array
     */
    protected function rules(): array
    {
        $defaultRules = 'required';
        $rules = [];

        foreach ($this->parameters as $parameter => $definition) {
            $options = $definition['options'];

            $rules[ $parameter ] = [$defaultRules, Rule::in(array_keys($options))];
        }

        return $rules;
    }

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
     * Validates user input from configurer
     *
     * @param array $form
     *
     * @return array
     * @throws InvalidParameterChoiceException
     */
    public function validateForm(array $form): array
    {
        try {
            return Validator::validate($form, $this->rules());
        } catch (ValidationException $e) {
            throw new InvalidParameterChoiceException;
        }
    }

    /**
     * Validates config then compute cost
     *
     * @param array $form
     *
     * @return array
     */
    public function resourceCost(array $form): array
    {
        try {
            $validatedForm = $this->validateForm($form);

            return $this->calculateResourceCost($validatedForm);
        } catch (InvalidParameterChoiceException $e) {
            return null;
        }
    }

    /**
     * Calculates resource usage for a given server configuration choice.
     *
     * @param array $form
     *
     * @return array
     */
    public function calculate(array $form): array
    {
        // Filter choices that were used in this calculator
        $usedOptions = collect($form)->only(array_keys($this->parameters))->toArray();

        // Map 'empty_value' for each parameter
        $defaultOptions = collect($this->parameters)->mapWithKeys(fn($value, $param) => [
            $param => $this->parameters[ $param ]['empty_value']]
        )->toArray();

        // Add default values to missing choices
        $form = array_merge($defaultOptions, $usedOptions);

        // Map possible parameter variables (that are compatible with the current choices)
        $options = collect($this->parameters)->mapWithKeys(fn($value, $parameter) => [
            $parameter => $this->computeAllPossibleOptions($parameter, $form),
        ])->toArray();

        // Replace possible choices into parameter list
        return collect($this->parameters)->mapWithKeys(fn($definition, $param) => [
            $param => array_merge(
                $definition,
                [
                    'options' => $options[ $param ],
                ],
            ),
        ])->toArray();
    }

    /**
     * Given a parameter name, variate all it's options against a configuration and filter
     * configurations that are get rejected by reject()
     *
     * @param string $parameter
     * @param array  $form
     *
     * @return array
     * @throws Exception
     */
    private function computeAllPossibleOptions(string $parameter, array $form): array
    {
        // Assert that the parameter is defined
        if (!array_key_exists('options', $this->parameters[ $parameter ])) {
            throw new Exception("Could not find 'options' definition for parameter $parameter");
        }

        $options = $this->parameters[ $parameter ]['options'];

        // Build a config for each parameter option and current choices, calculate cost and filter results.
        return collect($options)
            ->mapWithKeys(fn($text, $option) => [
                $option => array_merge($form, [$parameter => $option]),
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

            if ($cost > $this->node->$limit) {
                return true;
            }
        }

        return false;
    }
}
