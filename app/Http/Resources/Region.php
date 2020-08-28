<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Region extends JsonResource
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
            'country'           => new Country($this->whenLoaded('country')),
            'provinces'         => new ProvinceCollection($this->whenLoaded('provinces')),
            'states'            => new ProvinceCollection($this->whenLoaded('provinces')),
            'local_government_areas' => new LocalGovernmentAreaCollection($this->whenLoaded('localGovernmentAreas')),
            'cities'            => new CityCollection($this->whenLoaded('cities')),
            'villages'          => new VillageCollection($this->whenLoaded('villages')),
        ];
    }
}
