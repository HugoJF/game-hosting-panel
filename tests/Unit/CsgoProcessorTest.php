<?php

namespace Tests\Unit;

use App\Processors\CsgoProcessor;
use Illuminate\Support\Arr;
use Tests\TestCase;

class CsgoProcessorTest extends TestCase
{
    protected array $zeroCost = [
        'cpu'       => 0,
        'memory'    => 0,
        'disk'      => 0,
        'databases' => 0,
    ];
    protected array $possibleSlots = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '30'];
    protected array $possibleTickrate = ['64', '102.4', '128'];

    /**
     * @dataProvider goodProvider
     *
     * @param string $slots
     * @param string $tickrate
     */
    public function test_processor_will_return_resource_cost(string $slots, string $tickrate): void
    {
        $processor = new CsgoProcessor;

        $cost = $processor->resourceCost(compact('slots', 'tickrate'));

        $this->assertNotEquals($this->zeroCost, $cost);
    }

    /**
     * @dataProvider badProvider
     *
     * @param string $slots
     * @param string $tickrate
     */
    public function test_processor_will_return_nothing_if_parameter_is_missing(?string $slots, ?string $tickrate): void
    {
        $processor = new CsgoProcessor;

        $cost = $processor->resourceCost(compact('slots', 'tickrate'));

        $this->assertEquals($this->zeroCost, $cost);
    }

    public function goodProvider(): array
    {
        return Arr::crossJoin($this->possibleSlots, $this->possibleTickrate);
    }

    public function badProvider(): array
    {
        $noSlots = Arr::crossJoin([null], $this->possibleTickrate);
        $noTickrate = Arr::crossJoin($this->possibleSlots, [null]);

        return array_merge($noSlots, $noTickrate);
    }
}
