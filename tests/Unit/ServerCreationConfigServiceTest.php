<?php

namespace Tests\Unit;

use App\Game;
use App\Node;
use App\Server;
use App\Services\User\ServerCreationConfigService;
use App\User;
use HCGCloud\Pterodactyl\Pterodactyl;
use HCGCloud\Pterodactyl\Resources\Allocation;
use HCGCloud\Pterodactyl\Resources\Egg as EggResource;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ServerCreationConfigServiceTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    protected array $expectedConfig = [
        "feature_limits"      => [
            "databases"   => 0,
            "allocations" => 1,
        ],
        "egg"                 => null,
        "docker_image"        => "image:latest",
        "startup"             => "./myexec --param1 value1",
        "environment"         => [
            "var1" => "val1",
            "var2" => "val2",
        ],
        "name"                => "my server",
        "user"                => null,
        "node_id"             => 1,
        "start_on_completion" => false,
        "allocation"          => [
            "default" => null,
        ],
    ];

    public function test_creation_config_will_have_required_parameters(): void
    {
        $this->mock(Pterodactyl::class)
             ->shouldReceive('egg')
             ->once()
             ->andReturn(new EggResource([
                 'egg'           => 123,
                 'docker_image'  => 'image:latest',
                 'startup'       => './myexec --param1 value1',
                 'relationships' => [
                     'variables' => [
                         [
                             'env_variable'  => 'var1',
                             'default_value' => 'val1',
                         ], [
                             'env_variable'  => 'var2',
                             'default_value' => 'val2',
                         ],
                     ],
                 ],

             ]));

        $allocation = new Allocation([]);
        $game = factory(Game::class)->create();
        $node = factory(Node::class)->create();
        $user = factory(User::class)->create();

        $server = factory(Server::class)->create([
            'name'    => 'my server',
            'game_id' => $game->id,
            'node_id' => $node->id,
            'user_id' => $user->id,
        ]);

        $config = app(ServerCreationConfigService::class)->handle($user, $node, $game, $server, $allocation, []);

        $expected = array_merge(
            config('pterodactyl.server-creation-defaults'),
            $this->expectedConfig
        );

        $this->assertEquals($expected, $config);
    }
}
