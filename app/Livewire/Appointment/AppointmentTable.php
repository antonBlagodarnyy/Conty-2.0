<?php

namespace App\Livewire\Appointment;

use App\Models\Appointment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Locked;
use Illuminate\Support\Facades\Auth;
use RamonRietdijk\LivewireTables\Actions\Action;
use RamonRietdijk\LivewireTables\Columns\Column;
use RamonRietdijk\LivewireTables\Columns\DateColumn;
use RamonRietdijk\LivewireTables\Livewire\LivewireTable;

class AppointmentTable extends LivewireTable
{
   protected string $model = Appointment::class;

   #[Locked]
   public int $userId;

   public function mount()
   {
       $this->userId = Auth::user()->id;
   }
   
   /** @return Builder<covariant Model> */
   protected function query(): Builder
   {
       return $this->model()->query()->where('appointments.user_id', '=', $this->userId);
   }

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

         Action::make(
            __('Editar cita'),
            <<<JS
                   if(\$wire.selected.length>1){
                       alert('Escoja una sola cita para editar.')
                   } else {
                       \$wire.\$parent.\$set('editedAppointmentId',\$wire.selected[0]);
                       \$flux.modal('edit-appointment').show();
                       \$wire.dispatch('updateSelection');
                       
                   }
                   JS
         )
      ];
   }
}
