<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Country extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name'              => $this->name,
            'longitude'         => $this->longitude,
            'latitude'          => $this->latitude,
            'iso_code'          => $this->iso_code,
            'calling_code'      => $this->calling_code,
            'regions'           => new RegionCollection($this->whenLoaded('regions')),
            'provinces'         => new ProvinceCollection($this->whenLoaded('provinces')),
            'states'            => new ProvinceCollection($this->whenLoaded('provinces')),
            'local_government_areas' => new LocalGovernmentAreaCollection($this->whenLoaded('localGovernmentAreas')),
            'cities'            => new CityCollection($this->whenLoaded('cities')),
            'villages'          => new VillageCollection($this->whenLoaded('villages')),
        ];
    }
}
