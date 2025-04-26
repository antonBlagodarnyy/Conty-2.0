<?php

namespace App\Livewire\Service;


use App\Models\Service;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Livewire\Attributes\Locked;
use Illuminate\Support\Facades\Auth;
use RamonRietdijk\LivewireTables\Livewire\LivewireTable;
use RamonRietdijk\LivewireTables\Columns\Column;
use RamonRietdijk\LivewireTables\Actions\Action;

class ServiceTable extends LivewireTable
{
   protected string $model = Service::class;

   #[Locked]
    public int $userId;

    public function mount()
    {
        $this->userId = Auth::user()->id;
    }
    
    /** @return Builder<covariant Model> */
    protected function query(): Builder
    {
        return $this->model()->query()->where('user_id', '=', $this->userId);
    }

   protected function columns(): array
    {
        return [
            Column::make(__('Nombre'), 'name')
                ->searchable()
                ->sortable(),
            Column::make(__('Cobro'), 'charge'),

        ];
    }

    protected function actions(): array
    {
        return [
            Action::make(
                __('Eliminar servicio'),
                <<<JS
       if( confirm('Seguro que desea eliminar los servicios seleccionados?')){
         for (const e of \$wire.selected) {
                \$wire.\$parent.deleteService(e);
            }
        window.location.reload();
       }
    JS
            ),
            Action::make(
                __('Añadir servicio'),
                <<<JS
                \$flux.modal('add-service').show(); 
            JS
            )
                ->standalone(),

            Action::make(
                __('Editar servicio'),
                <<<JS
                    if(\$wire.selected.length>1){
                        alert('Escoja un solo servicio para editar.')
                    } else {
                        \$wire.\$parent.\$set('editedServiceId',\$wire.selected[0]);
                        \$flux.modal('edit-service').show();
                        
                    }
                    JS
            )
        ];
    }
}
