<?php

namespace App\Livewire\Service;

use App\Models\Service;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Attributes\Reactive;

class EditService extends Component
{
    #[Reactive]
    public $editedServiceId;

    #[Validate('required', onUpdate: false)]
    public $newName;

    #[Validate('required|min:1', onUpdate: false)]
    public $newCharge;

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
