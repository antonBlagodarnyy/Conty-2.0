<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    public function logout(){
        Auth::logout();
        redirect()->to('/');
    }
    public function render()
    {
        return view('livewire.dashboard');
    }
}
