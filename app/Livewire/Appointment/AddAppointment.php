<?php

namespace App\Livewire\Appointment;

use App\Models\Appointment;
use App\Models\Client;
use App\Models\Product;
use App\Rules\productInStock;
use App\Rules\selectedHaveQuantityRule;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;


class AddAppointment extends Component
{
    public $clientSelection, $products, $date, $job, $charge;

    public function save()
    {
        $this->validate();

        $appointment = new Appointment;
        $appointment->date = $this->date;
        $appointment->job = $this->job;
        $appointment->charge = $this->charge;

        $client = Client::find($this->clientSelection);
        $appointment->client_id = $client->id;

        $appointment->user_id = Auth::id();

        $appointment->save();


        foreach ($this->products['selected'] as $selectedId) {
            $appointment->products()->attach($selectedId, [
                'quantity' => $this->products['quantity'][$selectedId],
                'user_id' => Auth::id(),
            ]);

        }

        $appointment->refresh();

        session()->flash('message', 'Cita creada');
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
