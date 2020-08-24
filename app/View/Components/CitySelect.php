<?php

namespace App\View\Components;

use App\City;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class CitySelect extends Component
{
    /**
     * @var City|null
     */
    public $city;

    /**
     * @var City|Collection
     */
    public $cities;

    /**
     * CitySelect constructor.
     *
     * @param City|null $city
     * @param City|Collection $cities
     */
    public function __construct(City $cities, $city = null)
    {
        $this->city = $city;
        $this->cities = $cities->all();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.city-select');
    }
}
