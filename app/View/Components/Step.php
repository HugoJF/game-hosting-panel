<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Step extends Component
{
    protected string $number;
    protected string $image;

    /**
     * Create a new component instance.
     *
     * @param $number
     * @param $image
     */
    public function __construct($number, $image)
    {
        $this->number = $number;
        $this->image = $image;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('landing.components.step', [
            'number' => $this->number,
            'image'  => $this->image,
        ]);
    }
}
