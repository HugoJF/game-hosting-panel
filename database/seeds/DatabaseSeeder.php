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
            'first_name' => 'Hugo',
            'last_name'  => 'JF',
            'username'   => 'hugojf3',
            'email'      => 'asdasdasd@hotmail.com',
            'admin'      => true,
            'password'   => bcrypt('123123123'),
        ]);

        // Trigger event to register user on Database
        event(new Registered($user));

        // Allow all games on current Node
        foreach (Game::all() as $game) {
            Node::first()->games()->attach($game);
        }

        // Add money to test user
        $user->transactions()->save(factory(Transaction::class)->make([
            'value' => 100000,
        ]));

        // Update nodes
        Location::first()->update(['flag' => 'brazil']);
        factory(Location::class)->create([
            'id'    => 44,
            'short' => 'Remote',
            'long'  => 'Fake canada server',
            'flag'  => 'canada',
        ]);

        // Add covers to each game
        $covers = [
            'https://i.imgur.com/aSpVNeW.png',
            'https://i.imgur.com/rAwX8Af.png',
            'https://i.imgur.com/ADfCGqM.png',
            'https://i.redd.it/uhdomasbp1p31.png',
            'https://i.imgur.com/ORlkG0P.png',
        ];

        foreach ($covers as $id => $cover) {
            Game::query()->find($id + 1)->update(compact('cover'));
        }
    }
}
