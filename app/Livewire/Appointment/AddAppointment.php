<?php

namespace App\Livewire\Appointment;

use Livewire\Component;

class AddAppointment extends Component
{
    public $clientSelection;

    public function save(){
        error_log(json_encode($this->clientSelection));
    }
    public function render()
    {
        return view('livewire.appointment.add-appointment');
    }
}
