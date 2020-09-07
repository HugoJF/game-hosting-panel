<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class NodeForm extends Form
{
    private array $numberParameters = [
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

        $this->add('cpu_limit', 'number', $this->params('CPU limit (marks)'));
        $this->add('memory_limit', 'number', $this->params('Memory limit (MB)'));
        $this->add('disk_limit', 'number', $this->params('Disk limit (MB)'));
        $this->add('database_limit', 'number', $this->params('Database limit (units)'));
    }

    protected function params($text): array
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
