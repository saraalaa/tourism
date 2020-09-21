<?php
/**
 * Created by PhpStorm.
 * User: Me
 * Date: 9/21/2020
 * Time: 6:51 PM
 */

namespace App\Http\Traits;


trait CitiesTrait
{
    use ImageTrait;

    public function createCities($validated , $offer)
    {
        foreach ($validated['cities'] as $city){
            $cityImage = $this->prepareImage($city['image']);
            $readyCity=[
                $city['city_id'] =>[
                    'image' => asset('/image/' . $cityImage),
                    'hotel' => $city['hotel'],
                    'room_type' => $city['room_type'],
                    'arrive_date' => $city['arrive_date'],
                    'departure_date' => $city['departure_date'],
                    'services' => $city['services'],
                ]
            ];
            $offer->cities()->attach($readyCity);
        }
    }

    public function updateCities($validated , $offer){
        foreach ($validated['cities'] as $city){
            $cityImage = $this->prepareImage($city['image']);
            $readyCity=[
                $city['city_id'] =>[
                    'image' => asset('/image/' . $cityImage),
                    'hotel' => $city['hotel'],
                    'room_type' => $city['room_type'],
                    'arrive_date' => $city['arrive_date'],
                    'departure_date' => $city['departure_date'],
                    'services' => $city['services'],
                ]
            ];
            $offer->cities()->sync($readyCity,false);
        }
    }
}