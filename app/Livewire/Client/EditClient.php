<?php

namespace App\Livewire\Client;


use Livewire\Component;

use App\Models\Client;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Reactive;

class EditClient extends Component
{
    #[Reactive]
    public $editedClientId;

    #[Validate('required', onUpdate: false)]
    public $newName;
    #[Validate('required', onUpdate: false)]
    public $newPhone;

    protected $name, $phone;

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
