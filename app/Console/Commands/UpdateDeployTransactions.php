<?php

namespace App\Console\Commands;

use App\Deploy;
use App\Services\User\DeployCostService;
use App\Services\User\ServerTerminationService;
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

    protected function updateDeploy(Deploy $deploy)
    {
        $cost = $this->costService->getDeployCost($deploy);

        $transaction = $deploy->transaction;

        try {
            if ($transaction->value === -$cost) {
                return;
            }

            // Use try-catch to terminate server
            if ($deploy->termination_requested_at) {
                throw new Exception;
            }

            // This should raise an Exception if user does not have enough balance.
            $transaction->value = -$cost;
            $transaction->save();

            $this->info("Updating transaction $transaction->id to -$cost");
        } catch (Exception $e) {
            /** @var ServerTerminationService $terminationService */
            $terminationService = app(ServerTerminationService::class);

            $terminationService->handle($deploy->server);
        }
    }
}
