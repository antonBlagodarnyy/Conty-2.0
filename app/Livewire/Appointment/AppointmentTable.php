<?php

namespace App\Livewire\Appointment;

use App\Models\Appointment;
use Illuminate\Database\Eloquent\Model;
use RamonRietdijk\LivewireTables\Columns\Column;
use RamonRietdijk\LivewireTables\Columns\DateColumn;
use RamonRietdijk\LivewireTables\Livewire\LivewireTable;

class AppointmentTable extends LivewireTable
{
   protected string $model = Appointment::class;

   protected function columns(): array
   {
      return [
         DateColumn::make(__('Fecha'), 'date')
            ->searchable()
            ->sortable(),
         Column::make(__('Trabajo'), 'job'),
         Column::make(__('Cliente'), 'client.name'),
         Column::make(__('Productos'), 'products')
            ->displayUsing(function (mixed $products) {

               return view('livewire.appointment.table-product', ['products' => $products, 'quantity' => $products]);
            })->asHtml(),
      ];
   }
}
