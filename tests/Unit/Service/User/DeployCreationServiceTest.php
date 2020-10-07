<?php

namespace Tests\Unit\Service\User;

use App\Deploy;
use App\Exceptions\InsufficientBalanceException;
use App\Exceptions\InvalidBillingPeriodException;
use App\Exceptions\InvalidPeriodCostException;
use App\Exceptions\TooManyServersException;
use App\Services\User\DeployCostService;
use App\Services\User\DeployCreationService;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\Environments\ServerEnvironment;
use Tests\Environments\UserEnvironment;
use Tests\TestCase;

class DeployCreationServiceTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    protected int $costPerPeriod = 200;

    public function test_deploy_model_is_created(): void
    {
        $this->expectsCostCalculation();

        ($environment = new ServerEnvironment)
            ->serverFactory()
            ->setParameter('panel_id', 2);

        $environment->resolveDependencies();

        $deploy = app(DeployCreationService::class)->handle($environment->server(), 'daily', [
            'cpu'       => 1200,
            'memory'    => 512,
            'disk'      => 2500,
            'databases' => 1,
        ], []);

        $this->assertInstanceOf(Deploy::class, $deploy);
        $this->assertEquals($this->costPerPeriod, $deploy->cost_per_period);
    }

    protected function expectsCostCalculation(): void
    {
        // 'twice' since deploy has a creating() event listener that also uses getCostPerPeriod
        $this->partialMock(DeployCostService::class)
             ->shouldReceive('getCostPerPeriod')
             ->andReturn($this->costPerPeriod)
             ->twice();
    }

    public function test_invalid_billing_period_will_raise_exception(): void
    {
        ($environment = new UserEnvironment)
            ->userFactory()
            ->withBalance(9999)
            ->withServerLimit(1);

        $environment->resolveDependencies();

        $this->expectException(InvalidBillingPeriodException::class);

        app(DeployCreationService::class)->preChecks(
            $environment->user(),
            $environment->node(),
            'potato',
            []
        );
    }

    public function test_negative_deploy_cost_will_raise_exception(): void
    {
        ($environment = new UserEnvironment)
            ->userFactory()
            ->withBalance(5555)
            ->withServerLimit(1);

        $environment->resolveDependencies();

        $this->partialMock(DeployCostService::class)
             ->shouldReceive('getCostPerPeriod')
             ->andReturn(-200)
             ->once();

        $this->expectException(InvalidPeriodCostException::class);

        app(DeployCreationService::class)->preChecks(
            $environment->user(),
            $environment->node(),
            'daily',
            []
        );
    }

    public function test_user_with_insufficient_balance_will_raise_exception(): void
    {
        ($environment = new UserEnvironment)
            ->userFactory()
            ->withServerLimit(1)
            ->withBalance(50);

        $environment->resolveDependencies();

        $this->partialMock(DeployCostService::class)
             ->shouldReceive('getCostPerPeriod')
             ->andReturn(200)
             ->once();

        $this->expectException(InsufficientBalanceException::class);

        app(DeployCreationService::class)->preChecks(
            $environment->user(),
            $environment->node(),
            'daily',
            []
        );
    }

    public function test_creating_too_many_servers_will_raise_exception(): void
    {
        ($environment = new ServerEnvironment)
            ->serverFactory()
            ->setParameter('panel_id', 2);

        $environment->resolveDependencies();

        $this->partialMock(DeployCostService::class)
             ->shouldReceive('getCostPerPeriod')
             ->andReturn(200)
             ->once();

        $this->expectException(TooManyServersException::class);

        app(DeployCreationService::class)->preChecks(
            $environment->user(),
            $environment->node(),
            'daily',
            []
        );
    }
}
