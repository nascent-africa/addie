<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DeleteButton extends Component
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var int|string
     */
    public $id;

    /**
     * @var string
     */
    public $url;

    /**
     * @var string
     */
    public $classes;

    /**
     * DeleteButton constructor.
     *
     * @param string $name
     * @param int|string $id
     * @param string $url
     * @param string $classes
     */
    public function __construct(string $name, $id, string $url, string $classes ='btn btn-outline-danger')
    {
        $this->name = $name;
        $this->id = $id;
        $this->url = $url;
        $this->classes = $classes;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.delete-button');
    }
}
