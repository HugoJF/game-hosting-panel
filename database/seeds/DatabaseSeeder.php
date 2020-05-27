<?php

use App\Game;
use App\Node;
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
            'username'   => 'hugojf3',
            'email'      => 'asdasdasd@hotmail.com',
            'admin'      => true,
            'password'   => bcrypt('123123123'),
        ]);

        event(new \Illuminate\Auth\Events\Registered($user));

        foreach (Game::all() as $game) {
            Node::first()->games()->attach($game);
        }

        /** @var User $user */
        $user = User::first();
        $transaction = factory(Transaction::class)->make([
            'value' => 100000,
        ]);

        $user->transactions()->save($transaction);
    }
}
