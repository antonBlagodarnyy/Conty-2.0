<?php

namespace App\Livewire\Auth;



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
        //Valido al usuario
        $validate = $this->validate([
            'email' => ['required','string', new noUser()],
            'password' => 'required|string'
        ]);
        //Si es valido lo mando a hacer login
        if ($validate) {
            //Si hace login lo redirijo
            if ($authService->login($validate, $this->remember))
                redirect()->to('/dashboard/appointments');
        }
    }

   
    public function render()
    {
        return view('livewire.auth.login');
    }
}
