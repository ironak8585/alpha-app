<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TreeInput extends Component
{
    public $root;
    public $name;
    public $summarize;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($root, $name, $summary = 'false')
    {
        $this->root = $root;
        $this->name = $name;
        $this->summarize = $summary == 'true' ? true  : false;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.tree-input');
    }
}
