<?php

namespace App\Livewire\Appointment;

use App\Models\Service;
use Livewire\Attributes\Modelable;
use RamonRietdijk\LivewireTables\Livewire\LivewireTable;
use RamonRietdijk\LivewireTables\Columns\Column;

class SelectServiceTable extends  LivewireTable
{
    protected string $model = Service::class;

    #[Modelable]
    public $selection;


    protected function columns(): array
    {
        return [
            Column::make(__('Nombre'), 'name')
                ->searchable()
                ->sortable(),
                Column::make(__('Cobro'), 'charge')
                ->searchable()
                ->sortable(),
        ];
    }

    /**
     * Overwritting from the package to be able to select only one client
     */
    protected function canSelect(): bool
    {

        if (count($this->selected) < 1) {
            return true;
        } else {

            $this->selection = $this->selected[0];
            return false;
        }
    }

    /**
     * Overwritting from the package to unset the variable sent to the parent component 
     * on selection clearance
     *
     * @return void
     */
    public function clearSelection(): void
    {
        $this->selected = [];
        $this->selectedPage = false;
        unset($this->selection);
        $this->updateSession();
    }
}
