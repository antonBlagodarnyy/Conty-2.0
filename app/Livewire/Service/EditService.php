<?php

namespace App\Livewire\Service;

use App\Models\Service;
use Livewire\Component;
use Livewire\Attributes\Reactive;

class EditService extends Component
{
    #[Reactive]
    public $editedServiceId;
    public $newName, $newCharge;
    protected $name, $charge;
    
    public function boot()
    {
        $service = Service::find($this->editedServiceId);
        if ($service) {
            $this->name = $service->name;
            $this->charge = $service->charge;
        }
    }

    public function save()
    {
        $service = Service::find($this->editedServiceId);
        if($this->newName){
            $service->name = $this->newName;
        }
        if($this->newCharge){
            $service->charge = $this->newCharge;
        }


        if($service->save()){
            $this->js('window.location.reload()'); 
        } else{
            session()->flash('message', 'El servicio no se ha podido editar.');
        }

        
    }

    public function render()
    {
        return view('livewire.service.edit-service');
    }
}
