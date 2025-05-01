<?php

namespace App\Livewire\Service;

use App\Models\Service;
use Livewire\Component;

class Services extends Component
{
    public $editedServiceId;

    public function deleteClient($id){
        Service::where('id',$id)->delete();
    }

    public function clearAddForm(){
        $this->dispatch('clear-add-form');
    }
    public function clearEditForm(){
        $this->dispatch('clear-edit-form');
    }

    public function render()
    {
        return view('livewire.service.services');
    }
}
