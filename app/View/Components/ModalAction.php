<?php

namespace App\View\Components;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class ModalAction extends Component
{
    public $title;
    public $id;
    public $route;
    public $record;
    public $fields;

    /**
     * Create a new component instance.
     *
     * @param string $title
     * @param array $route
     * @param Model $record
     * @param array $fields
     * @return void
     */
    public function __construct($title, $route, $record, $fields)
    {
        //generate random id
        $this->id = Str::uuid();
        $this->title = $title;
        $this->route = $route;
        $this->record = $record;
        $this->fields = $fields;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.modal-action');
    }
}
