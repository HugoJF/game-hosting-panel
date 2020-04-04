<?php
/**
 * Created by PhpStorm.
 * User: Hugo
 * Date: 7/22/2019
 * Time: 1:11 AM
 */

namespace App\Services\Forms;

use App\Deploy;
use App\Forms\DeployForm;
use App\Server;
use Kris\LaravelFormBuilder\Form;

class DeployForms extends ServiceForm
{
	public function create(Server $server)
	{
		$form = $this->formBuilder->create(DeployForm::class, [
			'method' => 'POST',
			'url'    => route('deploys.store', $server),
		], [
			'server' => $server,
		]);

		return $form;
	}

	public function edit(Deploy $deploy)
	{
		$form = $this->formBuilder->create(DeployForm::class, [
			'method' => 'PATCH',
			'url'    => route('deploys.update', $deploy),
			'model'  => $deploy,
		], [
			'server' => $deploy->server,
		]);

		$this->disablePaidFields($form, $deploy);

		return $form;
	}

	protected function disablePaidFields(Form $form, Deploy $deploy)
	{
		$type = $deploy->server->node->type;
		$parameters = $deploy->server->game->parameters($type);

		$form->setDisabled('billing_period');
		foreach ($deploy->settings()->all() as $key => $value) {
			$field = $form->getField($key);
			if (!$field)
				continue;

			$field->setValue($value);
			$cost = $parameters[ $key ]['cost'] ?? false;

			if ($cost)
				$form->setDisabled($key);
		}
	}
}