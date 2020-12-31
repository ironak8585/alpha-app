<?php

namespace App\View\Components\Show;

use Illuminate\View\Component;

class Collection extends Component
{
    public $items;
    public $color;
    /**
     * Create a new component instance.
     *
     * @param array $items
     * @return void
     */
    public function __construct($items, $color = 'is-info')
    {
        $this->items = $items;
        $this->color = $color;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.show.collection');
    }
}
