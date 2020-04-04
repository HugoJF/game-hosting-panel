<?php

namespace App\Console\Commands;

use Artisan;
use Illuminate\Console\Command;
use Illuminate\Console\Scheduling\ScheduleRunCommand;

class SyncAll extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'panel:sync-all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync everything there is to sync';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $commands = [
            'panel:sync-eggs',
            'panel:sync-locations',
            'panel:sync-nodes',
        ];

        foreach ($commands as $command) {
            Artisan::call($command);
        }
    }
}
