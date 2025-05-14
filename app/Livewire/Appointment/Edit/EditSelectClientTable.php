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
    //Selecciono el modelo que usara la tabla
    protected string $model = Client::class;

    //Recogo el id del usuario en una propiedad protegida al inicializar el componente
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

    //Esta variable sera la que se mande al componente AddAppointment como clientSelection
    #[Modelable]
    public $selection;

    //El usuario que existe actualmente en la cita
    #[Reactive]
    public $clientSelection;
    
    //Actualizo la seleccion del formulario al abrir el modal
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
