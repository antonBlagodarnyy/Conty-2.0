<?php

namespace App\Livewire\auth;



use App\Services\AuthService;
use Livewire\Component;
use App\Rules\noUser;

class Login extends Component
{
    public $email;
    public $password;
    public $remember;

    public function save(AuthService $authService)
    {
        $validate = $this->validate([
            'email' => ['required','string', new noUser()],
            'password' => 'required|string'
        ]);
        if ($validate) {
            if ($authService->login($validate, $this->remember))
                redirect()->to('/dashboard/appointments');
        }
    }

   
    public function render()
    {
        return view('livewire.auth.login');
    }
}
