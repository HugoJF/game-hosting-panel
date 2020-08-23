<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CTA extends Component
{
    protected string $href;

    /**
     * Create a new component instance.
     *
     * @param string $href
     */
    public function __construct($href = '#')
    {
        $this->href = $href;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('landing.components.cta', [
            'href' => $this->href,
        ]);
    }
}
