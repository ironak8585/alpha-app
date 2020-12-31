<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PostAction extends Component
{

    public $route;
    public $confirm;
    public $icon;
    public $title;
    public $tooltip;
    public $color;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($route, $confirm = null, $icon = 'fa-check', $color = 'is-primary', $title = null, $tooltip = null)
    {
        $this->route = $route;
        $this->confirm = $confirm ? 'form-confirm' : '';
        $this->icon = $icon;
        $this->color = $color;
        $this->title = $title;
        $this->tooltip = $tooltip;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.post-action');
    }
}
