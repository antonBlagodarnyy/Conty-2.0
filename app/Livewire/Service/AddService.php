<?php

namespace App\Livewire\Service;

use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddService extends Component
{
    public $name;
    public $charge;

    public function save()
    {
        if (Service::create([
            'name' => $this->name,
            'charge' => $this->charge,
            'user_id' => Auth::id(),
        ])) {
            session()->flash('message', 'Servicio creado');
        }
    }
    public function render()
    {
        return view('livewire.service.add-service');
    }
}
