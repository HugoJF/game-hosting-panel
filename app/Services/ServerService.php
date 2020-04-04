<?php
/**
 * Created by PhpStorm.
 * User: Hugo
 * Date: 7/22/2019
 * Time: 12:48 AM
 */

namespace App\Services;

use App\Game;
use App\Location;
use App\Server;
use App\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;

class ServerService
{
	public function storeServer(Location $location, Game $game, User $user, array $data)
	{
		// TODO: figure out what node should be used
		$node = $location->nodes()->first();

		$configuration = array_keys($game->configuration($node->type));

		$server = Server::make($data);

		$server->node()->associate($node);
		$server->user()->associate($user);
		$server->game()->associate($game);
		$server->settings = collect($data)->only($configuration)->toArray();

		$server->save();

		return $server;
	}

	public function setServerTeam(Server $server, Team $team)
	{
		$server->team()->associate($team);

		$server->save();

		flash()->success("Server team switched to <strong>$team->name</strong>!");
	}

	public function removeServerTeam(Server $server)
	{
		$server->team_id = null;

		$server->save();
	}

	public function getCurrentDeploy(Server $server)
	{
		$deploys = $server->currentDeploy()->get();

		// Check if there's any deploys
		if ($deploys->count() === 0) {
			flash()->error('The server you are trying to terminate is not deployed!');

			return back();
		}

		// Check if there are multiple deploys going
		if ($deploys->count() >= 2) {
			flash()->error('Multiple deploys for the same server were found, <strong>this should never happen</strong>, please contact our support!');

			return back();
		}

		return $deploys->first();
	}

	public function generateConsoleJwt(User $user, $homeId)
	{
		$payload = JWTFactory::sub($user->getKey())->home($homeId)->make();

		$token = JWTAuth::encode($payload);

		return $token;
	}
}
