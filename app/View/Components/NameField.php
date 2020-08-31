<?php

namespace App\View\Components;

use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;

class NameField extends Component
{
    /**
     * @var Model
     */
    public $node;

    /**
     * Create a new component instance.
     *
     * @param Model|null $node
     */
    public function __construct(Model $node = null)
    {
        $this->node = $node;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.name-field');
    }
}
