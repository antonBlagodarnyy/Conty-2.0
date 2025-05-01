<?php

namespace App\Livewire\auth;

use App\Services\AuthService;
use Livewire\Component;

class Login extends Component
{
    public $email;
    public $password;
    public $remember;

    public function save(AuthService $authService)
    {
        $validate = $this->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);
        if ($validate) {
            if ($authService->login($validate, $this->remember)) redirect()->to('/dashboard/appointments');
        }
    }
    public function render()
    {
        return view('livewire.auth.login');
    }
}
