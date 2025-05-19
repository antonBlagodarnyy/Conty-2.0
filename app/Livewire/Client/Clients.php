<?php

namespace App\Livewire\Client;


use Livewire\Component;
use App\Models\Client;


class Clients extends Component
{
    //Guardo el cliente editado
    public $editedClientId;

    //Declaro los eventos
    public function clearAddForm(){
        $this->dispatch('clear-add-form');
    }
    public function clearEditForm(){
        $this->dispatch('clear-edit-form');
    }
    
    //Funcion para borrar al cliente
    public function deleteClient($id){
        Client::where('id',$id)->delete();
    }

    public function render()
    {
        return view('livewire.client.clients');
    }
}
