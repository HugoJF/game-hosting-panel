<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CarouselSelector extends Component
{
    protected string $count;
    protected ?string $selected;

    /**
     * Create a new component instance.
     *
     * @param      $count
     * @param null $selected
     */
    public function __construct($count, $selected = null)
    {
        $this->count = $count;
        $this->selected = $selected;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.carousel-selector', [
            'count'    => $this->count,
            'selected' => $this->selected,
        ]);
    }
}
