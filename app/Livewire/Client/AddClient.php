<?php

namespace App\Livewire\client;

use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;


class AddClient extends Component
{
    //Las vars del formulario con sus validaciones
    #[Validate('required', onUpdate: false)]
    public $name;
    #[Validate('required', onUpdate: false)]
    public $phone;

    //Al limpiar el formulario reinicio las vars
    #[On('clear-add-form')]
    public function clearForm()
    {
        $this->name = "";
        $this->phone = "";
    }

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
