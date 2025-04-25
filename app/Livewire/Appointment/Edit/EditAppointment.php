<?php

namespace App\Livewire\Appointment\Edit;

use Livewire\Component;
use Livewire\Attributes\Reactive;
use App\Models\Appointment;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class EditAppointment extends Component
{
    #[Reactive]
    public $editedAppointmentId;

    public $newDate, $newServiceSelection, $newClientSelection, $newProductsSelection;
    public $date, $serviceSelection, $clientSelection, $productsSelection;


    public function boot()
    {
        $appointment = Appointment::find($this->editedAppointmentId);

        if ($appointment) {
            $this->date = $appointment->date;
            $this->serviceSelection = $appointment->service_id;
            $this->clientSelection = $appointment->client_id;
            $this->productsSelection = $appointment->products;
        }
    }

    public function save()
    {
        //TODO Add valdiators: negatives and no selections
        $appointment = Appointment::find($this->editedAppointmentId);
        if ($this->newDate !== null) {
            $appointment->date = $this->newDate;
        }
        if ($this->newServiceSelection !== null) {
            $appointment->service_id = $this->newServiceSelection;
        }
        if ($this->newClientSelection !== null) {
            $appointment->client_id = $this->newClientSelection;
        }

        //cast newProductsSelection 
        //Livewire only supports passing to parent from children 1 var per component.
        //So to pass the selected components and their quantity, and to check if all selected had a quantity
        //I had to make an array with 2 keys, selected for all selected options, and quantity, which has an additional key with the id
        //In order to update the pivot table i had to format this array in to a new one
        $castedNewProducts = [];
        foreach ($this->newProductsSelection['selected'] as  $selection) {
            $castedNewProducts[$selection] = [
                'quantity' => $this->newProductsSelection['quantity'][$selection],
                'user_id' => Auth::id(),
            ];
        }

        //Update the products stock
        //Old products
        foreach ($this->productsSelection as $product) {

            //The product was selected but is not anymore
            if (!array_key_exists($product->id, $castedNewProducts)) {
                $product->stockInGrams += $product->pivot->quantity;

                //The product is still selected
            } else {
                //Was selected less quantity
                if ($product->pivot->quantity > $castedNewProducts[$product->id])
                    $product->stockInGrams += $product->pivot->quantity - $castedNewProducts[$product->id]['quantity'];

                //Was selected more quantity
                if ($product->pivot->quantity < $castedNewProducts[$product->id])
                    $product->stockInGrams -= $castedNewProducts[$product->id]['quantity'] - $product->pivot->quantity;
            }
            $product->save();
        }

        //New products
        foreach ($castedNewProducts as $id => $arrayWithQuantity) {
            //Was not selected before
            if (!$this->productsSelection->contains($id)) {
                $product = Product::find($id);
                $product->stockInGrams -= $arrayWithQuantity['quantity'];
                $product->save();
            }
        }


        //sync the products
        $appointment->products()->sync($castedNewProducts);

        if ($appointment->save()) {
            $this->js('window.location.reload()');
        } else {
            session()->flash('message', 'La cita no se ha podido editar.');
        }
    }

    public function render()
    {
        return view('livewire.appointment.edit.edit-appointment');
    }
}
