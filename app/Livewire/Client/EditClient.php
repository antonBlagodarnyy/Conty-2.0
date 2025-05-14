<?php

namespace App\Livewire\Client;


use Livewire\Component;

use App\Models\Client;
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;

class EditClient extends Component
{
    //Contiene el id del cliente que se va a editar, reactive por que viene del componente padre
    #[Reactive]
    public $editedClientId;

    //Valido los nuevos datos
    #[Validate('required', onUpdate: false)]
    public $newName;
    #[Validate('required', onUpdate: false)]
    public $newPhone;

    //Los datos anteriores
    protected $name, $phone;

    //Al cerrar el modal
    #[On('clear-edit-form')]
    public function clearForm()
    {
        $this->newName = "";
        $this->newPhone = "";
    }

    //Al abrir el modal
    public function boot()
    {
        $client = Client::find($this->editedClientId);
        if ($client) {
            $this->name = $client->name;
            $this->phone = $client->phone;
        }
    }

    public function save()
    {
        $client = Client::find($this->editedClientId);

        $client->name = $this->newName;
        $client->phone = $this->newPhone;

        $client->save();
        $this->js('window.location.reload()');
    }

    public function render()
    {
        return view('livewire.client.edit-client');
    }
}
