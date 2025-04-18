<?php

namespace App\Livewire\Client;


use Livewire\Component;

use App\Models\Client;
use Livewire\Attributes\Reactive;

class EditClient extends Component
{
    #[Reactive]
    public $editedClientId;
    public $newName, $newPhone;
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
        if($this->newName){
            $client->name = $this->newName;
        }
        if($this->newPhone){
            $client->phone = $this->newPhone;
        }


        if($client->save()){
            $this->js('window.location.reload()'); 
        } else{
            session()->flash('message', 'El cliente no se ha podido editar.');
        }

        
    }

    public function render()
    {
        return view('livewire.client.edit-client');
    }
}
