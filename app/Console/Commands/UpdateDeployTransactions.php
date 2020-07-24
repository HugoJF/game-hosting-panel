<?php

namespace App\Console\Commands;

use App\Deploy;
use App\Services\User\DeployCostService;
use App\Services\User\DeployTerminationService;
use Exception;
use Illuminate\Console\Command;

class UpdateDeployTransactions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deploys:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * @var DeployCostService
     */
    protected $costService;

    /**
     * Execute the console command.
     *
     * @param DeployCostService $costService
     *
     * @return mixed
     */
    public function handle(DeployCostService $costService)
    {
        $this->costService = $costService;

        $deploys = Deploy::query()
                         ->whereNull('terminated_at')
                         ->get();

        foreach ($deploys as $deploy) {
            $this->updateDeploy($deploy);
        }
    }

    protected function updateDeploy(Deploy $deploy): void
    {
        $realCost = $this->costService->getDeployCost($deploy, true);
        $cost = $this->costService->getDeployCost($deploy, false);

        $transaction = $deploy->transaction;

        try {
            if (abs($transaction->value) === abs($realCost)) {
                $this->info("Deploy $deploy->id cost did not change, skipping...");

                return;
            }

            // Use try-catch to terminate server
            if ($deploy->termination_requested_at) {
                $this->warn("Deploy $deploy->id cost changed and termination was requested...");
                throw new Exception;
            }

            // This should raise an Exception if user does not have enough balance.
            $transaction->value = -$cost;
            $transaction->save();

            $this->info("Updating transaction $transaction->id to -$cost");
        } catch (Exception $e) {
            report($e);
            /** @var DeployTerminationService $terminationService */
            $terminationService = app(DeployTerminationService::class);

            $this->info("Terminating deploy $deploy->id");
            $terminationService->handle($deploy->server, 'INSUFFICIENT_BALANCE', true);
        }
    }
}
