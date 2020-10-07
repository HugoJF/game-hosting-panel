<?php

namespace Tests\Unit;

use App\Processors\CsgoProcessor;
use App\Processors\MinecraftProcessor;
use Illuminate\Support\Arr;
use Tests\TestCase;

class MinecraftProcessorTest extends TestCase
{
    protected array $zeroCost = [
        'cpu'       => 0,
        'memory'    => 0,
        'disk'      => 0,
        'databases' => 0,
    ];
    protected array $possibleSlots = ['1', '5', '10', '30'];
    protected array $possiblePlugins = ['1', '5', '15', '30'];
    protected array $possibleSize = ['small', 'medium', 'large', 'huge'];

    /**
     * @dataProvider goodProvider
     *
     * @param string $slots
     * @param string $plugins
     * @param string $size
     *
     * @throws \App\Exceptions\MissingStubException
     */
    public function test_processor_will_return_resource_cost(
        string $slots,
        string $plugins,
        string $size
    ): void {
        $processor = new MinecraftProcessor;

        $cost = $processor->resourceCost(compact('slots', 'plugins', 'size'));

        $this->assertNotEquals($this->zeroCost, $cost);
    }

    public function goodProvider(): array
    {
        return Arr::crossJoin(
            $this->possibleSlots,
            $this->possiblePlugins,
            $this->possibleSize
        );
    }

    /**
     * @dataProvider badProvider
     *
     * @param string $slots
     * @param string $plugins
     * @param string $size
     *
     * @throws \App\Exceptions\MissingStubException
     */
    public function test_processor_will_return_nothing_if_parameter_is_missing(
        ?string $slots,
        ?string $plugins,
        ?string $size
    ): void {
        $processor = new CsgoProcessor;

        $cost = $processor->resourceCost(compact('slots', 'plugins', 'size'));

        $this->assertNull($cost);
    }

    public function badProvider(): array
    {
        $noSlots = Arr::crossJoin([null], $this->possiblePlugins, $this->possibleSize);
        $noPlugins = Arr::crossJoin($this->possibleSlots, [null], $this->possibleSize);
        $noSize = Arr::crossJoin($this->possibleSlots, $this->possiblePlugins, [null]);

        return array_merge($noSlots, $noPlugins, $noSize);
    }
}
