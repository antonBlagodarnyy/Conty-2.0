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
   //Selecciono el modelo que usara la tabla
   protected string $model = Appointment::class;

   //Recojo el id del usuario en una propiedad protegida al inicializar el componente
   #[Locked]
   public int $userId;
   public function mount()
   {
       $this->userId = Auth::user()->id;
   }
   //Retoco la query que realiza la tabla para que solo recoja los datos del usuario actual
   /** @return Builder<covariant Model> */
   protected function query(): Builder
   {
       return $this->model()->query()->where('appointments.user_id', '=', $this->userId);
   }

   //Creo las columnas
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
               //Calculo los costes totales
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
               //Calculo los beneficios
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

   //Creo las acciones
   protected function actions(): array
   {
      return [
         Action::make(
            __('Eliminar cita'),
            //Uso js
            <<<JS
      if( confirm('Seguro que desea eliminar las citas seleccionadas?')){
        for (const e of \$wire.selected) {
         //Llamo a la funcion del componente padre
               \$wire.\$parent.deleteAppointment(e);
           }
       window.location.reload();
      }
   JS
         ),
         Action::make(
            __('Añadir cita'),
            <<<JS
            //Muestro un modal
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
                     //Seteo la variable de la cita seleccionada
                     //Muestro el modal
                     //Disparo el evento para setear las variables en el modal
                       \$wire.\$parent.\$set('editedAppointmentId',\$wire.selected[0]);
                       \$flux.modal('edit-appointment').show();
                       \$wire.dispatch('updateSelection');
                       
                   }
                   JS
         )
      ];
   }
}
