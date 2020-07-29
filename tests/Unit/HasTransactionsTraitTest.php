<?php

namespace Tests\Unit;

use App\Transaction;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class HasTransactionsTraitTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    public function test_has_balance_makes_sense()
    {
        $user = factory(User::class)->create([
            'server_limit' => 1,
        ]);
        factory(Transaction::class)->create([
            'value'   => 50,
            'user_id' => $user->id,
        ]);

        $this->assertTrue($user->hasBalance(50));
        $this->assertTrue($user->hasBalance(-500));
        $this->assertFalse($user->hasBalance(500));
    }

}
