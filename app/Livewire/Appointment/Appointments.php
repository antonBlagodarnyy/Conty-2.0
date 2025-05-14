<?php

namespace App\Livewire\Appointment;

use App\Models\Appointment;
use Livewire\Component;

class Appointments extends Component
{
    //Guardo el producto editado en caso de hacerlo
    public $editedAppointmentId;
    
    //Emito los eventos en caso de requerirlo
    public function clearAddForm(){
        $this->dispatch('clear-add-form');
    }
    public function clearEditForm(){
        $this->dispatch('clear-edit-form');
    }
    
    //En caso de eliminar una cita
    public function deleteAppointment($id)
    {
        $appoitnment = Appointment::find($id);
        foreach ($appoitnment->products as $product) {
            $product->stockInGrams += $product->pivot->quantity;
            $product->save();
        }
        Appointment::where('id', $id)->delete();
    }

    public function render()
    {
        return view('livewire.appointment.appointments');
    }
}
