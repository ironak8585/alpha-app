<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DefaultAction extends Component
{
    public $routePrefix;
    public $id;
    public $edit;
    public $show;
    public $delete;

    /**
     * Create a new component instance.
     *
     * @param string $routePrefix
     * @param mixed $id
     * @param bool $show
     * @param bool $edit
     * @param bool $delete
     * @return void
     */
    public function __construct($routePrefix, $id, $show = true, $edit = true, $delete = true)
    {
        //
        $this->routePrefix = $routePrefix;
        $this->id = $id;
        $this->show = $show;
        $this->edit = $edit;
        $this->delete = $delete;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.default-action');
    }
}
