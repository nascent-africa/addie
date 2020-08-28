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
        ];
    }
}
