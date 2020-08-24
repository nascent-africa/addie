<?php

namespace App\View\Components;

use App\Region;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class RegionSelect extends Component
{
    /**
     * @var Region
     */
    public $region;

    /**
     * @var Collection|Region
     */
    public $regions;

    /**
     * RegionSelect constructor.
     *
     * @param Region $regions
     * @param Collection|null $region
     */
    public function __construct(Region $regions, $region = null)
    {
        $this->region = $region;
        $this->regions = $regions->all();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.region-select');
    }
}
