<?php

namespace App\Livewire\Appointment;

use App\Models\Appointment;
use RamonRietdijk\LivewireTables\Livewire\LivewireTable;

class AppointmentTable extends LivewireTable
{
   protected string $model = Appointment::class;
}
