<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateOfferRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['string', 'max:255'],
            'adult_price' => ['regex:/^\d+(\.\d{1,2})?$/', 'numeric', 'between:0,999999.99'],
            'children_price' => ['regex:/^\d+(\.\d{1,2})?$/', 'numeric', 'between:0,999999.99'],
            'image' => ['image', 'mimes:png,jpeg,jpg,gif,svg', 'max:5120'],
            'arrive_date' => ['date', 'after_or_equal:today', 'before_or_equal:departure_date'],
            'departure_date' => ['date', 'after_or_equal:arrive_date'],
            'gallery.*.image' => ['image', 'mimes:png,jpeg,jpg,gif,svg', 'max:5120'],
            'cities.*.city_id' => [
                'required_with:cities.*.image,cities.*.hotel,cities.*.room_type,cities.*.services,cities.*.arrive_date,cities.*.departure_date',
                'exists:cities,id'],
            'cities.*.image' => ['required_with:cities.*.city_id', 'image', 'mimes:png,jpeg,jpg,gif,svg', 'max:5120'],
            'cities.*.hotel' => ['required_with:cities.*.city_id', 'string', 'max:255'],
            'cities.*.room_type' => ['required_with:cities.*.city_id', Rule::in(['single', 'double']) ],
            'cities.*.services' => ['json'],
            'cities.*.arrive_date' => ['required_with:cities.*.city_id', 'date', 'after_or_equal:today', 'before_or_equal:departure_date',
                'before_or_equal:cities.*.departure_date'],
            'cities.*.departure_date' => ['required_with:cities.*.city_id', 'date', 'after_or_equal:arrive_date'],
        ];
    }
}
