<?php

namespace App\Livewire\Appointment;

use App\Models\Appointment;
use Livewire\Component;

class Appointments extends Component
{
    public function deleteAppointment($id){
        Appointment::where('id',$id)->delete();
    }

    public function render()
    {
        return view('livewire.appointment.appointments');
    }
}
