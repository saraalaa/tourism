<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TokenController extends Controller
{
    public function create(){

        // this simple function responsible for create token just for demo

        request()->validate([
            'email' =>  ['required', Rule::in(['user@gmail.com']) ],
            'password' => ['required', Rule::in(['12345678']) ],
            'device_name' => ['required'],
        ]);

        $user = User::where('email', request()->email)->first();

        return $user->createToken(request()->device_name)->plainTextToken;
    }
}
