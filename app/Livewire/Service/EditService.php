<?php

namespace App\Livewire\Service;

use App\Models\Service;
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Attributes\Reactive;

class EditService extends Component
{
    //Contiene el id del servicio que se va a editar, reactive por que viene del componente padre
    #[Reactive]
    public $editedServiceId;

    //Valido los nuevos datos
    #[Validate('required', onUpdate: false)]
    public $newName;
    #[Validate('required|min:1', onUpdate: false)]
    public $newCharge;

    //Los datos anteriores
    protected $name, $charge;

    //Al cerrar el modal
    #[On('clear-edit-form')]
    public function clearForm()
    {
        $this->newName = "";
        $this->newCharge = "";
    }

    //Al abrir el modal
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
        $this->validate();

        $service = Service::find($this->editedServiceId);

        $service->name = $this->newName;
        $service->charge = $this->newCharge;

        $service->save();
        
        $this->js('window.location.reload()');

    }

    public function render()
    {
        return view('livewire.service.edit-service');
    }
}
