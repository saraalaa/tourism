<?php

namespace App\Http\Traits;

use Illuminate\Support\Str;

trait ImageTrait
{
    public function prepareImage($image)
    {
        $storedImageName = Str::uuid() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('image');
        $image->move($destinationPath,$storedImageName);
        return $storedImageName;
    }
}