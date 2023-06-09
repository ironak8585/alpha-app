<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AppLayout extends Component
{

    public $breadcrumbs;

    /**
     * Create a new component instance.
     *
     * @param array $breadcrumbs
     * @return void
     */
    public function __construct($breadcrumbs = [])
    {
        //
        $this->breadcrumbs = $breadcrumbs;
    }

    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('layouts.app');
    }
}
