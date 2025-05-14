<?php

namespace App\Livewire\client;

use App\Models\Client;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Livewire\Attributes\Locked;
use Illuminate\Support\Facades\Auth;
use RamonRietdijk\LivewireTables\Livewire\LivewireTable;
use RamonRietdijk\LivewireTables\Columns\Column;
use RamonRietdijk\LivewireTables\Actions\Action;

class ClientTable extends LivewireTable
{
    //Selecciono el modelo que usara la tabla
    protected string $model = Client::class;

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
        return $this->model()->query()->where('user_id', '=', $this->userId);
    }

    //Creo las columnas
    protected function columns(): array
    {
        return [
            Column::make(__('Nombre'), 'name')
                ->searchable()
                ->sortable(),
            Column::make(__('Telefono'), 'phone'),

        ];
    }

    //Creo las acciones
    protected function actions(): array
    {
        return [
            Action::make(
                __('Eliminar cliente'),
                //Uso js
                <<<JS
       if( confirm('Seguro que desea eliminar a los clientes seleccionados?')){
         for (const e of \$wire.selected) {
            //Lanzo la funcion del componente padre
                \$wire.\$parent.deleteClient(e);
            }
        window.location.reload();
       }
    JS
            ),
            Action::make(
                __('Añadir cliente'),
                <<<JS
                //Muestro el modal
                \$flux.modal('add-client').show(); 
            JS
            )
                ->standalone(),

            Action::make(
                __('Editar cliente'),
                <<<JS
                    if(\$wire.selected.length>1){
                        alert('Escoja un solo cliente para editar.')
                    } else {
                        //Seteo el cliente a editar
                        \$wire.\$parent.\$set('editedClientId',\$wire.selected[0]);
                        //Muestro el modal
                        \$flux.modal('edit-client').show();
                        
                    }
                    JS
            )
        ];
    }
}
