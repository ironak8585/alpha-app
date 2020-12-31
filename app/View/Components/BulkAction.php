<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BulkAction extends Component
{

    public $route;
    public $actions;
    /**
     * Create a new component instance.
     *
     * @param string $route
     * @param array $actions
     * @return void
     */
    public function __construct($route, $actions)
    {
        $this->route = $route;
        $this->actions = $actions;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.bulk-action');
    }
}
