<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'image', 'hotel', 'room_type', 'services', 'arrive_date', 'departure_date'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function offers()
    {
        return $this->belongsToMany(Offer::class)
            ->withPivot('image','hotel','room_type','services','arrive_date','departure_date');
    }
}
