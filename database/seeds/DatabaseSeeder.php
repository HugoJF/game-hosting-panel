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
    	factory(User::class, 5)->create();
    	factory(Transaction::class, 500)->create();
    	factory(Location::class, 5)->create();
    	factory(Node::class, 10)->create();
    	factory(Game::class, 10)->create();
    	factory(Server::class, 5)->create();
    }
}
