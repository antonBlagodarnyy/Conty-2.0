<?php

namespace App\Livewire;

use App\Models\Client;
use RamonRietdijk\LivewireTables\Livewire\LivewireTable;
use RamonRietdijk\LivewireTables\Columns\Column;

class ClientTable extends LivewireTable
{
    protected string $model = Client::class;

    protected function columns(): array{
        return [
            Column::make(__('Nombre'), 'name'),
            Column::make(__('Telefono'),'phone'),
        ];
    }
}
