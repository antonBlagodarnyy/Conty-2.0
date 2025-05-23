<?php

namespace App\Livewire\Appointment\Add;

use App\Models\Appointment;
use App\Models\Service;
use App\Models\Client;
use App\Models\Product;
use App\Rules\productInStock;
use App\Rules\quantityNotNegative;
use App\Rules\selectedHaveQuantityRule;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;


class AddAppointment extends Component
{
    public $clientSelection, $serviceSelection, $products, $date;

    public function save()
    {
        //valido los datos introducidos en el formulario
        $this->validate();

        //Creo la nueva cita
        $appointment = new Appointment;
        $appointment->date = $this->date;

        //busco su servicio su cliente y el usuario actual y lo asigno
        $service  = Service::find($this->serviceSelection);
        $appointment->service_id = $service->id;

        $client = Client::find($this->clientSelection);
        $appointment->client_id = $client->id;

        $appointment->user_id = Auth::id();

        $appointment->save();

        //Asigno los productos seleccionados a la tabla pivot
        foreach ($this->products['selected'] as $selectedId) {

            //Create the pivot table
            $appointment->products()->attach($selectedId, [
                'quantity' => $this->products['quantity'][$selectedId],
                'user_id' => Auth::id(),
            ]);

            //Remove grams from  stock
            $product = Product::find($selectedId);
            $product->stockInGrams -= $this->products['quantity'][$selectedId];
            $product->save();
        }

        $appointment->refresh();

        $this->js('window.location.reload()');
    }
    //Las reglas del formulario
    protected function rules()
    {
        return [
            'date' => 'required',
            'serviceSelection' => 'required',
            'clientSelection' => 'required',
            'products' => [
                new selectedHaveQuantityRule(),
                new productInStock(),
                new quantityNotNegative()
            ]
        ];
    }

    //Metodo propio de laravel
    public function render()
    {
        return view('livewire.appointment.add.add-appointment');
    }
}
