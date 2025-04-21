<?php

namespace App\Livewire\Appointment;

use App\Models\Appointment;
use App\Rules\productInStock;
use App\Rules\selectedHaveQuantityRule;
use Livewire\Component;


class AddAppointment extends Component
{
    public $clientSelection, $products, $date, $job;

    public function save()
    {
        $this->validate();
        error_log("fun");
    }
    protected function rules()
    {
        return [
            'date' => 'required',
            'job' => 'required',
            'clientSelection' => 'required',
            'products' => [new selectedHaveQuantityRule(), new productInStock()]
        ];
    }

    public function render()
    {
        return view('livewire.appointment.add-appointment');
    }
}
