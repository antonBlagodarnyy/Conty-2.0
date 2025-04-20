<?php

namespace App\Livewire\Appointment;

use App\Models\Appointment;
use Livewire\Component;

class AddAppointment extends Component
{
    public $clientSelection;
    public $productsSelection;

    public function save(){
        error_log(json_encode($this->productsSelection));

    }
    public function render()
    {
        return view('livewire.appointment.add-appointment');
    }
}
