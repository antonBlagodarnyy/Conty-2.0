<?php

namespace App\Livewire\client;


use Livewire\Component;
use App\Models\Client;


class Clients extends Component
{
    public $editedClientId;

    public function clearAddForm(){
        $this->dispatch('clear-add-form');
    }
    public function clearEditForm(){
        $this->dispatch('clear-edit-form');
    }
    
    public function deleteClient($id){
        Client::where('id',$id)->delete();
    }

    public function render()
    {
        return view('livewire.client.clients');
    }
}
