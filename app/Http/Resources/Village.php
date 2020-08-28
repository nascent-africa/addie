<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Village extends JsonResource
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
            'region'            => new Region($this->whenLoaded('region')),
            'province'         => new Province($this->whenLoaded('province')),
            'state'            => new Province($this->whenLoaded('province')),
            'local_government_area'            => new LocalGovernmentArea($this->whenLoaded('localGovernmentArea')),
            'city'          => new City($this->whenLoaded('city')),
        ];
    }
}
