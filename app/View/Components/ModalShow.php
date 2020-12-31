<?php

namespace App\View\Components;

use Illuminate\Support\Str;
use Illuminate\View\Component;

class ModalShow extends Component
{
    public $id;
    public $title;
    public $tooltip;
    public $icon;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title = "", $icon = 'fas fa-external-link-square-alt', $tooltip = null)
    {
        $this->id = Str::uuid();
        $this->title = $title;
        $this->tooltip = $tooltip;
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.modal-show');
    }
}
