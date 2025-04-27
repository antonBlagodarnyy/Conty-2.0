<?php

namespace App\Livewire\Service;

use App\Models\Service;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddService extends Component
{
    #[Validate('required', onUpdate: false)]
    public $name;
    #[Validate('required|min:1', onUpdate: false)]
    public $charge;

    public function save()
    {
        $this->validate();

        Service::create([
            'name' => $this->name,
            'charge' => $this->charge,
            'user_id' => Auth::id(),
        ]);

        $this->js('window.location.reload()');
    }
    public function render()
    {
        return view('livewire.service.add-service');
    }
}
