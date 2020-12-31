<?php

namespace App\View\Components\Show;

use Illuminate\View\Component;
use Illuminate\Database\Eloquent\Model;

class Timestamps extends Component
{

    public $record;

    /**
     * Create a new component instance.
     *
     * @param Model
     * @return void
     */
    public function __construct(Model $record)
    {
        $this->record = $record;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.show.timestamps');
    }
}
