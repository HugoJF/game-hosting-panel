<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class NodeForm extends Form
{
    private $numberParameters = [
        'attr' => [
            'step' => '0.001',
        ],
        'min'  => 0,
    ];

    public function buildForm()
    {
        $this->add('name', 'text');
        $this->add('description', 'textarea');

        $this->add('cpu_cost', 'number', $this->params('Cost per 1 CPU Mark'));
        $this->add('memory_cost', 'number', $this->params('Cost per MB of memory'));
        $this->add('disk_cost', 'number', $this->params('Cost per MB of disk'));
        $this->add('database_cost', 'number', $this->params('Cost per database'));
    }

    protected function params($text)
    {
        return $this->numberParameters + [
                'help_block' => [
                    'text' => $text,
                    'tag'  => 'small',
                    'attr' => ['class' => 'form-text text-muted']
                ],
            ];
    }
}
