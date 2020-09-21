<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
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
            'title' => $this->title,
            'adult_price' => $this->adult_price,
            'children_price' => $this->children_price,
            'image' => $this->image,
            'arrive_date' => $this->arrive_date,
            'departure_date' => $this->departure_date,
            'duration' => $this->offerDuration(),
            'gallery' => GalleryResource::collection($this->whenLoaded('galleries')),
            'cities' => CityResource::collection($this->whenLoaded('cities')),
        ];
    }
}