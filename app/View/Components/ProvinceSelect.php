<?php

namespace App\View\Components;

use App\Province;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class ProvinceSelect extends Component
{
    /**
     * @var Province
     */
    public $province;

    /**
     * @var Province|Collection|null
     */
    public $provinces;

    /**
     * ProvinceSelect constructor.
     *
     * @param Province $province
     * @param Province|Collection|null $provinces
     */
    public function __construct($province, Province $provinces)
    {
        $this->province = $province;
        $this->provinces = $provinces->all();
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.province-select');
    }
}
