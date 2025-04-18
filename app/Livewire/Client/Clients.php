<?php

namespace App\Livewire\client;


use Livewire\Component;
use App\Models\Client;


class Clients extends Component
{
    public $editedClientId;

    public function deleteClient($id){
        Client::where('id',$id)->delete();
    }

    public function render()
    {
        return view('livewire.client.clients');
    }
}
