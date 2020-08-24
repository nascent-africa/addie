<?php

namespace App\View\Components;

use App\LocalGovernmentArea;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class LocalGovernmentAreaSelect extends Component
{
    /**
     * @var LocalGovernmentArea|null
     */
    public $localGovernmentArea;

    /**
     * @var Collection|LocalGovernmentArea
     */
    public $localGovernmentAreas;

    /**
     * LocalGovernmentAreaSelect constructor.
     *
     * @param LocalGovernmentArea|Collection $localGovernmentAreas
     * @param LocalGovernmentArea|null $localGovernmentArea
     */
    public function __construct(LocalGovernmentArea $localGovernmentAreas, $localGovernmentArea = null)
    {
        $this->localGovernmentArea = $localGovernmentArea;
        $this->localGovernmentAreas = $localGovernmentAreas->all();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.local-government-area-select');
    }
}
