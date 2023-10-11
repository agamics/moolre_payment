<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    // Register User
    public function register(Request $io)
    {
        $io->validate([
            'sur_name' => 'required|string',
            'other_names' => 'required|string',
            'mobile' => 'required|string|max:10|min:10',
            'email' => 'required|string|unique:users|email',
            'password' => 'required|string'
        ]);

        $user = new User;
        $user->email = $io->email;
        $user->password = bcrypt($io->password);
        $user->save();
        $user_id = $user->id;

        $token = $user->createToken('myapptoken')->plainTextToken;

        Client::create([
            'user_id' => $user_id,
            'sur_name' => $io->sur_name,
            'other_names' => $io->other_names,
            'mobile' => $io->mobile
        ]);
    }
}
