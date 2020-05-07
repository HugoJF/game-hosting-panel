<?php

use App\Game;
use App\Node;
use App\Location;
use App\Server;
use App\Transaction;
use App\User;
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
            'username'   => 'hugojf',
            'email'      => 'asdasdasd@hotmail.com',
            'admin'      => true,
            'password'   => bcrypt('123123123'),
        ]);

        foreach (Game::all() as $game) {
            Node::first()->games()->attach($game);
        }

        $user->transactions()->
    }
}
