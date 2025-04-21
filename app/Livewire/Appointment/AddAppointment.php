<?php

namespace App\Livewire\Appointment;

use App\Models\Appointment;
use Livewire\Component;


class AddAppointment extends Component
{
    public $clientSelection, $products, $date, $job;

    public function save(){
        error_log(json_encode($this->products));

    }
    protected function rules()
    {
        return [
            'date' => 'required',
            'job' => 'required',
            'clientSelection' => 'required',
        ];
    }
    public function render()
    {
        return view('livewire.appointment.add-appointment');
    }
}
