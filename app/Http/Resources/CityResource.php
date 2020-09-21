<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'country' => new CountryResource($this->country),
            'image' => $this->pivot->image,
            'hotel' => $this->pivot->hotel,
            'room_type' => $this->pivot->room_type,
            'services' => json_decode($this->pivot->services),
            'arrive_date' => $this->pivot->arrive_date,
            'departure_date' => $this->pivot->departure_date,
        ];
    }
}
