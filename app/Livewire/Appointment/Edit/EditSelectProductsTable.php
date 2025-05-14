<?php

namespace App\Livewire\Appointment\Edit;

use App\Models\Product;
use Livewire\Attributes\Modelable;
use Livewire\Attributes\Reactive;
use Livewire\Attributes\On;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Livewire\Attributes\Locked;
use Illuminate\Support\Facades\Auth;
use RamonRietdijk\LivewireTables\Livewire\LivewireTable;
use RamonRietdijk\LivewireTables\Columns\Column;


class EditSelectProductsTable extends  LivewireTable
{
     //Selecciono el modelo que usara la tabla
    protected string $model = Product::class;

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

    //Esta variable sera la que se mande al componente AddAppointment como productos
    #[Modelable]
    public $products = ['quantity' => [], 'selected' => []];

    //Los productos actuales de la cita
    #[Reactive]
    public $productsSelection;

    //Actualizo la seleccion de productos para que sea la misma que los productos actuales de la cita
    #[On('updateSelection')]
    public function updateSelection()
    {
        $this->selected = [];
        foreach ($this->productsSelection as  $product) {
            $this->selected[] = $product->id . "";
            $this->products['quantity'][$product->id] = $product->pivot->quantity;
        }

    }

    protected function columns(): array
    {
        return [
            Column::make(__('Nombre'), 'name')
                ->searchable()
                ->sortable(),
            Column::make(__('Stock'), 'stockInGrams'),
            Column::make(__('Cantidad'), 'id')
                ->displayUsing(function (mixed $id) {
                    //Si no esta seleccionado, no se puede editar la cantidad
                    $disabled = !in_array("" . $id, $this->selected);

                    //Si ya tiene una cantidad, se muestra
                    if (isset($this->products['quantity'][$id]))
                        $introducedQuantity = $this->products['quantity'][$id];
                    else
                        $introducedQuantity = "";

                    return view('livewire.appointment.add.input-product', [
                        'productId' => $id,
                        'disabled' => $disabled,
                        'introducedQuantity' => $introducedQuantity
                    ]);
                })->asHtml(),
        ];
    }

    //Actualiza la cantidad del input en la variable
    public function saveQuantity($productId, $quantity)
    {
        $this->products['quantity'][$productId] = $quantity;
    }

    //Actualizo los productos seleccionados
    protected function canSelect(): bool
    {
        $this->products['selected'] = $this->selected;
        return true;
    }
}
