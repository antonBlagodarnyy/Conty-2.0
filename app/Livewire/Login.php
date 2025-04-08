<?php

namespace App\Livewire;

use App\Services\AuthService;
use Barryvdh\Debugbar\Facades\Debugbar;
use Barryvdh\Debugbar\Twig\Extension\Debug;
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
            $authService->login($validate) ?
                redirect()->to('/dashboard') :
                redirect()->to('/login');
        }
    }
    public function render()
    {
        return view('livewire.login');
    }
}
