<?php

namespace App\View\Components\Show;

use Illuminate\View\Component;

class TagList extends Component
{

    public $records;
    public $actions;
    public $show;
    public $edit;
    public $delete;
    public $routePrefix;
    public $title;
    public $subtitle;
    public $code;
    
    /**
     * Create a new component instance.
     *
     * @param Collection $records
     * @param array $actions
     * @return void
     */
    public function __construct($records, $actions, $route, $title, $show=true, $edit=true, $delete=true, $subtitle = null, $code = null)
    {
        $this->records = $records;
        $this->actions = $actions;
        $this->routePrefix = $route;
        $this->title = $title;
        $this->show = $show;
        $this->edit = $edit;
        $this->delete = $delete;
        $this->subtitle = $subtitle;
        $this->code = $code;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.show.tag-list');
    }
}
