<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'adult_price', 'children_price', 'image', 'arrive_date', 'departure_date'
    ];

    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }

    public function cities()
    {
        return $this->belongsToMany(City::class)
            ->withPivot('image','hotel','room_type','services','arrive_date','departure_date');
    }

    public function offerDuration()
    {
       return Carbon::parse($this->arrive_date)->diff($this->departure_date)->format('%d days');
    }
}
