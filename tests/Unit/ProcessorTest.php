<?php

namespace Tests\Unit;

use App\Game;
use App\Node;
use App\Services\GameService;
use Illuminate\Support\Arr;
use Tests\TestCase;

class ProcessorTest extends TestCase
{
    /**
     * @dataProvider gameProvider
     *
     * @param Game $game
     */
    public function test_calculate_with_empty_parameters_will_return_all_options(Game $game): void
    {
        $service = app(GameService::class);
        $node = factory(Node::class)->make([
            'cpu_limit'       => 30000,
            'memory_limit'    => 50000,
            'disk_limit'      => 1000000,
            'database_limit' => 10,
        ]);

        $processor = $service->getProcessor($game)->setNode($node);

        $parameters = array_keys(config("processors.$game->stub.parameters"));

        $result = $processor->calculate([]);

        foreach ($parameters as $parameter) {
            $actual = config("processors.$game->stub.parameters.$parameter.options");
            $generated = Arr::get($result, "$parameter.options");

            $this->assertEquals(array_keys($actual), array_keys($generated));
        }
    }

    public function gameProvider(): array
    {
        return [
            [new Game(['stub' => 'csgo'])],
            [new Game(['stub' => 'minecraft'])],
        ];
    }

}
