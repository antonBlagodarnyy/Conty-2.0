<?php

namespace App\Livewire\client;

use Livewire\Component;

use App\Models\Client;
use Illuminate\Support\Facades\Auth;

use function Laravel\Prompts\alert;

class AddClient extends Component
{
    public $name;
    public $phone;

    public function save()
    {
        if (Client::create([
            'name' => $this->name,
            'phone' => $this->phone,
            'user_id' => Auth::id(),
        ])) {
            session()->flash('message', 'Cliente creado');
        }
    }
    public function render()
    {
        return view('livewire.client.add-client');
    }
}
