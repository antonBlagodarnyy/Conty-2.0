<?php

namespace App\Livewire;


use Livewire\Component;
use App\Models\Client;

class Clients extends Component
{

    public function deleteClient($id){
        Client::where('id',$id)->delete();
    }
}
