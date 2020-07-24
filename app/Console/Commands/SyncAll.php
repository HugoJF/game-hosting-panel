<?php

namespace App\Console\Commands;

use Artisan;
use Illuminate\Console\Command;

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
     * @return void
     */
    public function handle(): void
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
