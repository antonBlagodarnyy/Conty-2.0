<?php

namespace App\Livewire;

use App\Services\AuthService;
use Livewire\Component;

class Login extends Component
{
    public $email;
    public $password;

    public function save(AuthService $authService)
    {
        $validate = $this->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);
        if ($validate) {
            if ($authService->login($validate)) redirect()->to('/dashboard');
        }
    }
    public function render()
    {
        return view('livewire.login');
    }
}
