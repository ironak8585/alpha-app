<?php

namespace App\View\Components\Form;

use Illuminate\Support\Str;
use Illuminate\View\Component;

class Number extends Component
{
    public $name;
    public $value;
    public $id;
    public $label;
    public $attr;
    public $icon;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $value = null, $id = null, $label = null, $icon = true, $attributes = [])
    {
        $this->name = $name;
        $this->value = $value;        
        $this->id = $id ? $id : str_replace('_', '-', $name);
        $this->label = $label ? $label : ($label === false ? false : Str::title(str_replace('_', ' ', $name)));
        $this->icon = $icon;
        $defaults = [
            'id' => $this->id, 
            'class' => 'input has-text-right',
        ];
        $this->attr = array_merge($defaults, $attributes);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.forms.number');
    }
}
