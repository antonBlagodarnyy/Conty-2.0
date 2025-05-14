<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Navbar extends Component
{
    //Funcion para cerrar sesion
    public function logout(){
        Auth::logout();
        redirect()->to('/');
    }
    public function render()
    {
        return view('livewire.navbar');
    }
}
