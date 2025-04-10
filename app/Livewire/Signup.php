<?php

namespace App\Livewire;

use App\Services\AuthService;
use Livewire\Component;


class Signup extends Component
{
    public $name;
    public $email;
    public $password;
    public $password_confirmation;


    public function save(AuthService $authService)
    {
        $validate = $this->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed',
        ]);

        if ($validate) {
            if ($authService->signUp($validate)) redirect()->to('/dashboard');
        }
    }
    public function render()
    {
        return view('livewire.signup');
    }
}
