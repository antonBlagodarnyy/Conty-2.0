<?php

namespace App\Livewire\Appointment;

use App\Models\Client;
use Livewire\Attributes\Modelable;
use RamonRietdijk\LivewireTables\Livewire\LivewireTable;
use RamonRietdijk\LivewireTables\Columns\Column;

class SelectClientTable extends  LivewireTable
{
    protected string $model = Client::class;

    #[Modelable]
    public $selection;


    protected function columns(): array
    {
        return [
            Column::make(__('Nombre'), 'name')
                ->searchable()
                ->sortable(),
        ];
    }
    protected function canSelect(): bool
    {

        if (count($this->selected) < 1) {

            return true;
        } else {
            $this->selection = $this->selected[0];
            return false;
        }
    }
}
