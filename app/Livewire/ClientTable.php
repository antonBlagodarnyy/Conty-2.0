<?php

namespace App\Livewire;

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
        confirm('Seguro que desea eliminar a los clientes seleccionados?',\$wire.\$parent.deleteClient(\$wire.selected));
        window.location.reload();
    JS
            ),
        ];
    }
}
