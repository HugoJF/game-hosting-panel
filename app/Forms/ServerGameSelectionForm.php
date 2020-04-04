<?php

namespace App\Forms;

use App\Location;
use Kris\LaravelFormBuilder\Form;

class ServerGameSelectionForm extends Form
{
	public function buildForm()
	{
		$this->game();
	}

	protected function game(): void
	{
		$this->add('game', 'select', [
			'choices'     => $this->fetchGames(),
			'empty_value' => '=== Select game ===',
		]);
	}

	private function fetchGames()
	{
		$games = $this->getData('games');

		return $games->mapWithKeys(function ($game) {
			return [$game->id => $game->name];
		})->toArray();
	}
}
