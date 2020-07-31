<?php

namespace Tests\Browser;

use App\Game;
use App\Location;
use App\Node;
use App\Transaction;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Throwable;

class ServerCreationTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test example.
     *
     * @return void
     * @throws Throwable
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $location = factory(Location::class)->create([
                'id'    => 1,
                'short' => 'Loc',
                'flag'  => 'brazil',
            ]);

            $game = factory(Game::class)->create([
                'name'  => 'SuperGame',
                'cover' => asset('images/cod4.png'),
            ]);

            /** @var Node $node */
            $node = factory(Node::class)->create([
                'name'          => 'Main',
                'cpu_cost'      => 100,
                'memory_cost'   => 2,
                'disk_cost'     => 0.2,
                'database_cost' => 500,
                'location_id'   => 1,
            ]);

            $node->games()->sync([$game->id]);

            $user = factory(User::class)->create([
                'panel_id' => 1,
            ]);

            factory(Transaction::class)->create([
                'value'   => 1000,
                'user_id' => $user->id,
            ]);

            $locationText = implode(' | ', [$location->short, $location->long]);

            $browser
                ->loginAs($user)
                ->visit(route('dashboard'))
                ->screenshot('dashboard')
                ->assertSee('Create server')
                ->clickLink('Create server')
                ->assertSee('Create a new server')
                ->waitForText('Loc', 10)
                ->click('img[alt="SuperGame"]')
                ->waitForText('Loc', 10)
                ->click("img[alt=\"$locationText\"]")
                ->screenshot('server_creation');
        });
    }
}
