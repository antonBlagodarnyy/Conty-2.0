<?php

namespace App\Livewire\Appointment;

use App\Models\Appointment;
use Illuminate\Database\Eloquent\Model;
use RamonRietdijk\LivewireTables\Actions\Action;
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

         Column::make(__('Cliente'), 'client.name')
            ->searchable()
            ->sortable(),

         Column::make(__('Servicio'), 'service.name'),

         Column::make(__('Productos'), 'products')
            ->displayUsing(function (mixed $products) {
               return view('livewire.appointment.table-product', ['products' => $products]);
            })->asHtml(),

         Column::make(__('Costes totales'), 'products')
            ->displayUsing(function (mixed $products): string {
               $totalCosts = 0;
               foreach ($products as $product) {
                  $cost = ($product->price / $product->net_content) * $product->pivot->quantity;
                  $totalCosts += $cost;
               }
               return number_format($totalCosts, 2) . "€";
            }),

         Column::make(__('Cobro'), 'service.charge')
            ->displayUsing(function (mixed $value, Model $model): string {
               return $value . "€";
            }),

         Column::make(__('Beneficios'), function (mixed $value, Model $model): string {
            $totalCosts = 0;
            foreach ($model->products as $product) {
               $cost = ($product->price / $product->net_content) * $product->pivot->quantity;
               $totalCosts += $cost;
            }
            $benefits =  $model->service->charge - $totalCosts;
            return number_format($benefits, 2) . "€";
         })
      ];
   }

   protected function actions(): array
   {
      return [
         Action::make(
            __('Eliminar cita'),
            <<<JS
      if( confirm('Seguro que desea eliminar las citas seleccionadas?')){
        for (const e of \$wire.selected) {
               \$wire.\$parent.deleteAppointment(e);
           }
       window.location.reload();
      }
   JS
         ),
         Action::make(
            __('Añadir cita'),
            <<<JS
               \$flux.modal('add-appointment').show(); 
           JS
         )
            ->standalone(),
      ];
   }
}
