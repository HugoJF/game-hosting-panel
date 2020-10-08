<?php

use App\Game;
use App\Location;
use App\Node;
use App\Transaction;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Artisan::call('panel:sync-all');

        /** @var User $user */
        $user = factory(User::class)->create([
            'first_name'   => 'Hugo',
            'last_name'    => 'JF',
            'username'     => 'hugojf3',
            'email'        => 'asdasdasd@hotmail.com',
            'admin'        => true,
            'server_limit' => 999,
            'password'     => bcrypt('123123123'),
        ]);

        // Trigger event to register user on Database
        event(new Registered($user));

        // Allow all games on current Node
        foreach (Game::all() as $game) {
            Node::first()->games()->attach($game);
        }

        // Add base cost for local node
        Node::first()->update([
            'cpu_cost'      => 2.1,
            'memory_cost'   => 2,
            'disk_cost'     => 0.05,
            'database_cost' => 500,
        ]);

        // Add money to test user
        $user->transactions()->save(factory(Transaction::class)->make([
            'value' => 100000,
        ]));

        // Update nodes
        Location::first()->update([
            'description' => 'Located on Mato Grosso do Sul, BR at my own house.',
            'flag'        => 'brazil',
        ]);
        factory(Location::class)->create([
            'id'          => 44,
            'short'       => 'Remote',
            'long'        => 'Fake canada server',
            'description' => 'Located on Ontario, CA at OVH T3 datacenter.',
            'flag'        => 'canada',
        ]);

        // Add covers to each game
        $updates = [
            [
                'cover' => asset('/images/css.png'),
                'stub'  => 'csgo',
            ], [
                'cover' => asset('/images/csgo.png'),
                'stub'  => 'csgo',
            ], [
                'cover' => asset('/images/cod2.png'),
                'stub'  => 'minecraft',
            ], [
                'cover' => asset('/images/cod4.png'),
                'stub'  => 'minecraft',
            ], [
                'cover' => asset('/images/minecraft.png'),
                'stub'  => 'minecraft',
            ],
        ];

        foreach ($updates as $id => $update) {
            Game::query()->find($id + 1)->update($update);
        }
    }
}
