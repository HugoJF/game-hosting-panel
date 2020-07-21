<?php

namespace App\Forms;

use App\Server;
use App\Traits\DynamicForm;
use App\Traits\FormSetDisabled;
use Kris\LaravelFormBuilder\Form;

class DeployForm extends Form
{
    use FormSetDisabled;
    use DynamicForm;

    /** @var Server */
    private $server;

    public function buildForm()
    {
        $this->server = $this->getData('server');

        $this->addDefaultDeployFields();
        $this->addGameSpecificFields();
    }

    protected function addDefaultDeployFields()
    {
		$this->add('billing_period', 'select', [
            'choices' => [
                'minutely' => 'Each minute',
                'hourly'   => 'Each hour',
                'daily'    => 'Each day',
                'weekly'   => 'Each week',
                'monthly'  => 'Each month',
            ],
        ]);
	}

    protected function addGameSpecificFields(): void
    {
        $type = $this->server->node->type;
        $config = $this->server->game->parameters($type);

        $this->buildDeployForm($config);
    }

}
