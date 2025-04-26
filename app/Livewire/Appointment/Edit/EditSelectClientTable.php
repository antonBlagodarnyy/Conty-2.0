<?php

namespace App\Livewire\Appointment\Edit;

use App\Models\Client;
use Livewire\Attributes\Modelable;
use Livewire\Attributes\Reactive;
use Livewire\Attributes\On;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Livewire\Attributes\Locked;
use Illuminate\Support\Facades\Auth;
use RamonRietdijk\LivewireTables\Livewire\LivewireTable;
use RamonRietdijk\LivewireTables\Columns\Column;

class EditSelectClientTable extends  LivewireTable
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

    #[Modelable]
    public $selection;

    #[Reactive]
    public $clientSelection;

    #[On('updateSelection')]
    public function updateSelection()
    {
        $this->selected = [$this->clientSelection . ""];
    }
    protected function columns(): array
    {
        return [
            Column::make(__('Nombre'), 'name')
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
