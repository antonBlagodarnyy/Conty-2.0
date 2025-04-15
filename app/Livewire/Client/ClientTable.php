<?php

namespace App\Livewire\client;

use App\Models\Client;
use RamonRietdijk\LivewireTables\Livewire\LivewireTable;
use RamonRietdijk\LivewireTables\Columns\Column;
use RamonRietdijk\LivewireTables\Actions\Action;

class ClientTable extends LivewireTable
{
    protected string $model = Client::class;


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
                \$wire.\$parent.deleteClient(\$wire.selected);
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

        ];
    }
}
