<?php

namespace App\Console\Commands;

use App\Deploy;
use Illuminate\Console\Command;

class UpdateDeploys extends Command
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
	protected $description = 'Check for each deploy';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
		$deploys = Deploy::whereNull('terminated_at')->get();

		$this->updateDeploys($deploys);
	}

	private function updateDeploys($deploys)
	{
		foreach ($deploys as $deploy) {
			$this->info("Updating deploy $deploy->id");
			$this->updateDeploy($deploy);
		}
	}

	private function updateDeploy(Deploy $deploy)
	{
		$deploy->updateTransaction();
	}
}
