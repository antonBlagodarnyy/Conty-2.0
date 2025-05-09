<?php

namespace App\Services;

use App\Models\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function signUp(array $data): bool
    {
        $user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        return $user->wasRecentlyCreated;
    }

    public function login(array $data, $remember)
    {
        return Auth::attempt($data, $remember);
    }
}
