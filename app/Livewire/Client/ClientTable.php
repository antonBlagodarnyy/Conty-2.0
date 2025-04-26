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
    protected string $model = Client::class;

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
            Column::make(__('Telefono'), 'phone'),

        ];
    }

    protected function actions(): array
    {
        return [
            Action::make(
                __('Eliminar cliente'),
                <<<JS
       if( confirm('Seguro que desea eliminar a los clientes seleccionados?')){
         for (const e of \$wire.selected) {
                \$wire.\$parent.deleteClient(e);
            }
        window.location.reload();
       }
    JS
            ),
            Action::make(
                __('Añadir cliente'),
                <<<JS
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
                        \$wire.\$parent.\$set('editedClientId',\$wire.selected[0]);
                        \$flux.modal('edit-client').show();
                        
                    }
                    JS
            )
        ];
    }
}
