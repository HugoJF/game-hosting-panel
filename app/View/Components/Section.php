<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Section extends Component
{
    protected string $img;
    protected string $alt;
    protected string $specs;
    protected string $price;
    protected string $period;

    /**
     * Create a new component instance.
     *
     * @param $img
     * @param $alt
     * @param $specs
     * @param $price
     * @param $period
     */
    public function __construct($img, $alt, $specs, $price, $period)
    {
        $this->img = $img;
        $this->alt = $alt;
        $this->specs = $specs;
        $this->price = $price;
        $this->period = $period;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('landing.components.game-card', [
            'img'    => $this->img,
            'alt'    => $this->alt,
            'specs'  => $this->specs,
            'price'  => $this->price,
            'period' => $this->period,
        ]);
    }
}
