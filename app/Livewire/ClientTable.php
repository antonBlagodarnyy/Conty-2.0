<?php

namespace App\Livewire;

use Barryvdh\Debugbar;
use App\Models\Client;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Support\Enumerable;
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
            Action::make(__('Eliminar cliente'), 'confirm("Seguro que desea eliminar a los clientes seleccionados?",$wire.$parent.deleteClient($wire.selected))'),
        ];
    }
}
