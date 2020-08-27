<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Well extends Component
{
    protected string $padding;

    /**
     * Create a new component instance.
     *
     * @param $padding
     */
    public function __construct($padding = '8')
    {
        $this->padding = $padding;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('landing.components.well', [
            'padding' => $this->padding,
        ]);
    }
}
