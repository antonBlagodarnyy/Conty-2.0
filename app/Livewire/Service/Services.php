<?php

namespace App\Livewire\Service;

use App\Models\Service;
use Livewire\Component;

class Services extends Component
{
    //Guardo el servicio editado
    public $editedServiceId;

    //Funcion para eliminar el servicio
    public function deleteService($id){
        Service::where('id',$id)->delete();
    }

    //Declaro los eventos
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
