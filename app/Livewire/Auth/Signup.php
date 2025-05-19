<?php

namespace App\Livewire\Auth;

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
        //Valido al usuario
        $validate = $this->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed',
        ]);
        //Si es valido
        if ($validate) {
            //Lo registro, hago login y redirijo
            if ($authService->signUp($validate)) {
                $authService->login($validate, false);
                redirect()->to('/dashboard/appointments');
            }
        }
    }
    public function render()
    {
        return view('livewire.auth.signup');
    }
}
