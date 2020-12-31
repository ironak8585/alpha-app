<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Pagination extends Component
{

    public $records;
    public $filters;

    /**
     * Create a new component instance.
     *
     * @param Collection $records
     * @param array $filters
     * @return void
     */
    public function __construct($records, $filters)
    {
        $this->records = $records;
        $this->filters = $filters;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.pagination');
    }
}
