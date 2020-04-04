<?php
/**
 * Created by PhpStorm.
 * User: Hugo
 * Date: 7/23/2019
 * Time: 2:51 AM
 */

namespace App\Services\Forms;

use App\Forms\ServerForm;
use App\Forms\ServerGameSelectionForm;
use App\Game;
use App\Node;
use App\Location;
use App\User;

class ServerForms extends ServiceForm
{
	public function select(Location $location, User $user)
	{
		$limit = $user->server_limit;

		if ($user->servers()->count() > $limit) {
			flash()->error("You account is limited to $limit servers, please request more servers with our support!");

			return null;
		}

		return $this->formBuilder->create(ServerGameSelectionForm::class, [
			'method' => 'GET',
			'url'    => route('servers.create', $location),
		], [
			'games' => $location->games,
		]);
	}

	public function create(Location $location, Game $game, Node $node)
	{
		return $this->formBuilder->create(ServerForm::class, [
			'method' => 'POST',
			'url'    => route('servers.store', [$location, $game]),
		], [
			'game' => $game,
			'node' => $node,
		]);
	}
}
