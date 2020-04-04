<?php
/**
 * Created by PhpStorm.
 * User: Hugo
 * Date: 7/22/2019
 * Time: 12:47 AM
 */

namespace App\Services;

use App\Deploy;
use App\Server;

class DeployService
{
	/**
	 * Stores new Deploy if user can afford first unit of time.
	 *
	 * @param Server $server
	 * @param array  $deployParameters
	 *
	 * @return Deploy|null
	 */
	public function storeDeploy(Server $server, array $deployParameters)
	{
		$type = $server->node->type;
		$parameters = $server->game->parameters($type);
		$keys = array_keys($parameters);

		// Create deploy object
		$deploy = Deploy::make($deployParameters);

		$deploy->server()->associate($server);
		$deploy->settings = collect($deployParameters)->only($keys)->toArray();

		// Calculate the cost of deployment of the first unit of time
		$driver = $server->driver();
		$cost = $driver->cost($deploy, 1);
		$balance = $server->user->balance;

		// Check if server owner has enough balance to deploy
		if ($cost > $balance) {
			flash()->error('Not enough balance to deploy server!');

			return null;
		}

		$deploy->save();

		return $deploy;
	}

	/**
	 * Updates Deploy information.
	 *
	 * @param Deploy $deploy
	 * @param array  $data
	 *
	 * @return Deploy
	 */
	public function updateDeploy(Deploy $deploy, array $data)
	{
		$parameters = $this->getUpdatableDeployParameters($deploy);

		foreach ($parameters as $key => $value) {
			$value = $data[ $key ] ?? null;
			if ($value)
				$deploy->settings()->set($key, $value);
		}

		$deploy->save();

		return $deploy;
	}

	/**
	 * Returns Deploy parameters that can be changed without redeploying the Server (that are not used to compute costs).
	 *
	 * @param Deploy $deploy
	 *
	 * @return array
	 */
	public function getUpdatableDeployParameters(Deploy $deploy)
	{
		$type = $deploy->server->node->type;
		$parameters = $deploy->server->game->parameters($type);

		// Filter parameters that cost something
		$parameters = collect($parameters)->filter(function ($item) {
			return !($item['cost'] ?? false);
		})->toArray();

		return $parameters;
	}
}