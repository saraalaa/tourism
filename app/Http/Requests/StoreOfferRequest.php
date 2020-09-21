<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreOfferRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'adult_price' => ['required', 'regex:/^\d+(\.\d{1,2})?$/', 'numeric', 'between:0,999999.99'],
            'children_price' => ['required', 'regex:/^\d+(\.\d{1,2})?$/', 'numeric', 'between:0,999999.99'],
            'image' => ['required', 'image', 'mimes:png,jpeg,jpg,gif,svg', 'max:5120'],
            'arrive_date' => ['required', 'date', 'after_or_equal:today', 'before_or_equal:departure_date'],
            'departure_date' => ['required', 'date', 'after_or_equal:arrive_date'],
            'gallery.*.image' => ['required', 'image', 'mimes:png,jpeg,jpg,gif,svg', 'max:5120'],
            'cities.*.city_id' => ['required', 'exists:cities,id'],
            'cities.*.image' => ['required', 'image', 'mimes:png,jpeg,jpg,gif,svg', 'max:5120'],
            'cities.*.hotel' => ['required', 'string', 'max:255'],
            'cities.*.room_type' => ['required', Rule::in(['single', 'double']) ],
            'cities.*.services' => ['json'],
            'cities.*.arrive_date' => ['required', 'date', 'after_or_equal:today', 'before_or_equal:departure_date',
                'before_or_equal:cities.*.departure_date'],
            'cities.*.departure_date' => ['required', 'date', 'after_or_equal:arrive_date'],
        ];
    }
}
