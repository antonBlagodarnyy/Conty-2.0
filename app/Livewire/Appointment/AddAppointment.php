<?php

namespace App\Livewire\Appointment;

use App\Models\Appointment;
use App\Rules\selectedHaveQuantityRule;
use Livewire\Component;


class AddAppointment extends Component
{
    public $clientSelection, $products, $date, $job;

    public function save()
    {
        $this->validate();
    }
    protected function rules()
    {
        return [
            'date' => 'required',
            'job' => 'required',
            'clientSelection' => 'array|size:1',
            'products' => new selectedHaveQuantityRule(),
        ];
    }

    public function render()
    {
        return view('livewire.appointment.add-appointment');
    }
}
