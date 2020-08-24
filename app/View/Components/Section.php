<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Section extends Component
{
    protected string $title;
    protected string $description;
    protected string $theme;

    /**
     * Create a new component instance.
     *
     * @param $title
     * @param $description
     * @param $theme
     */
    public function __construct($title, $description = '', $theme = 'white')
    {
        $this->title = $title;
        $this->description = $description;
        $this->theme = $theme;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('landing.components.section', [
            'title'       => $this->title,
            'description' => $this->description,
            'theme'       => $this->theme,
        ]);
    }
}
