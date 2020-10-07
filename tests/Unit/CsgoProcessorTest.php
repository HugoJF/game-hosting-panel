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
    protected array $possibleSlots = ['12', '16', '20', '24', '28', '32', '36', '40'];
    protected array $possibleTickrate = ['64', '102.4', '128'];
    protected array $possibleDatabases = ['0', '1'];

    /**
     * @dataProvider goodProvider
     *
     * @param string $slots
     * @param string $tickrate
     * @param string $databases
     *
     * @throws \App\Exceptions\MissingStubException
     */
    public function test_processor_will_return_resource_cost(
        string $slots,
        string $tickrate,
        string $databases
    ): void {
        $processor = new CsgoProcessor;

        $cost = $processor->resourceCost(compact('slots', 'tickrate', 'databases'));

        $this->assertNotEquals($this->zeroCost, $cost);
    }

    /**
     * @dataProvider badProvider
     *
     * @param string      $slots
     * @param string      $tickrate
     *
     * @param string|null $databases
     *
     * @throws \App\Exceptions\MissingStubException
     */
    public function test_processor_will_return_nothing_if_parameter_is_missing(
        ?string $slots,
        ?string $tickrate,
        ?string $databases
    ): void {
        $processor = new CsgoProcessor;

        $cost = $processor->resourceCost(compact('slots', 'tickrate', 'databases'));

        $this->assertNull($cost);
    }

    public function goodProvider(): array
    {
        return Arr::crossJoin($this->possibleSlots, $this->possibleTickrate, $this->possibleDatabases);
    }

    public function badProvider(): array
    {
        $noSlots = Arr::crossJoin([null], $this->possibleTickrate, $this->possibleDatabases);
        $noTickrate = Arr::crossJoin($this->possibleSlots, [null], $this->possibleDatabases);
        $noDatabases = Arr::crossJoin($this->possibleSlots, $this->possibleTickrate, [null]);

        return array_merge($noSlots, $noTickrate, $noDatabases);
    }
}
