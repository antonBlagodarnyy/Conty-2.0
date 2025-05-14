<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Welcome extends Component
{

    public function mount()
    {
        //Si hay una sesion activa, entra en el programa
        if (Auth::check()) {
            redirect()->to('/dashboard/appointments');
        }
    }
    public function render()
    {
        return view('livewire.welcome');
    }
}
