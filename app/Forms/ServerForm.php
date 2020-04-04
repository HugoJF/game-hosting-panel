<?php

namespace App\Forms;

use App\Game;
use App\Node;
use Kris\LaravelFormBuilder\Form;

class ServerForm extends Form
{
	/** @var Node */
	private $node;
	/** Game */
	private $game;

	public function buildForm()
	{
		$this->node = $this->getData('node');
		$this->game = $this->getData('game');

		$this->addDefaultFields();
		$this->addGameSpecificFields();
	}

	protected function addDefaultFields()
	{
		$this->add('name', 'text');
	}

	protected function addGameSpecificFields()
	{
		$configs = $this->game->configuration($this->node->type);

		foreach ($configs as $name => $config) {
			$this->buildField($name, $config);
		}
	}

	protected function buildField($name, $config)
	{
		if (!array_key_exists('type', $config))
			return;

		$this->add($name, $config['type'], $config['options'] ?? []);
	}
}
