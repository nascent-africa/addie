<?php

namespace App\View\Components;

use App\Country;
use Illuminate\View\Component;

class CountrySelect extends Component
{
    /**
     * @var
     */
    public $countries;

    /**
     * @var Country|null
     */
    public $country;

    /**
     * CountrySelect constructor.
     * @param $countries
     * @param Country|null $country
     */
    public function __construct(Country $countries, $country = null)
    {
        $this->countries = $countries->all();
        $this->country = $country;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.country-select');
    }
}
