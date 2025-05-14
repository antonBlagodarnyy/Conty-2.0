<?php

namespace App\Livewire\Appointment\Add;

use App\Models\Product;
use Livewire\Attributes\Modelable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Livewire\Attributes\Locked;
use Illuminate\Support\Facades\Auth;
use RamonRietdijk\LivewireTables\Livewire\LivewireTable;
use RamonRietdijk\LivewireTables\Columns\Column;

class AddSelectProductsTable extends  LivewireTable
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

    //Creo las columnas
    protected function columns(): array
    {
        return [
            Column::make(__('Nombre'), 'name')
                ->searchable()
                ->sortable(),
            Column::make(__('Stock'), 'stockInGrams'),
            Column::make(__('Cantidad'), 'id')
                ->displayUsing(function (mixed $id) {
                    //Si no esta seleccionado esa fila, no se podra editar ese input
                    $disabled = !in_array("" . $id, $this->selected);

                    //Si ya se ha introducido una cantidad anteriormente, se guarda y se muestra
                    $introducedQuantity = "";
                    if (isset($this->products['quantity'][$id]))
                        $introducedQuantity = $this->products['quantity'][$id];

                    return view('livewire.appointment.add.input-product', [
                        'productId' => $id,
                        'disabled' => $disabled,
                        'introducedQuantity' => $introducedQuantity,
                    ]);
                })->asHtml(),
        ];
    }
    //Guarda la cantidad introducida en input-product al pulsar la tecla
    public function saveQuantity($productId, $quantity)
    {
        $this->products['quantity'][$productId] = $quantity;
    }

    //Guarda el producto seleccionado
    protected function canSelect(): bool
    {
        $this->products['selected'] = $this->selected;
        return true;
    }
}
