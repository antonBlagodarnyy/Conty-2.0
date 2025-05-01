<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Welcome extends Component
{

    public function mount()
    {
        if (Auth::check()) {
            redirect()->to('/dashboard/appointments');
        }
    }
 
}
