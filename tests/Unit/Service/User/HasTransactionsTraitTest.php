<?php

namespace Tests\Unit\Service\User;

use App\Transaction;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\Environments\ServerEnvironment;
use Tests\Environments\UserEnvironment;
use Tests\TestCase;

class HasTransactionsTraitTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    public function test_has_balance_makes_sense()
    {
        ($environment = new UserEnvironment)
            ->userFactory()
            ->withBalance(50);

        $environment->resolveDependencies();

        $this->assertTrue($environment->user()->hasBalance(50));
        $this->assertTrue($environment->user()->hasBalance(-500));
        $this->assertFalse($environment->user()->hasBalance(500));
    }

}
