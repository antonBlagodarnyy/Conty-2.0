<?php

namespace App\Livewire\client;

use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;


class AddClient extends Component
{
    #[Validate('required', onUpdate: false)]
    public $name;
    #[Validate('required', onUpdate: false)]
    public $phone;

    public function save()
    {
        $this->validate();

        Client::create([
            'name' => $this->name,
            'phone' => $this->phone,
            'user_id' => Auth::id(),
        ]);
    }
    public function render()
    {
        return view('livewire.client.add-client');
    }
}
