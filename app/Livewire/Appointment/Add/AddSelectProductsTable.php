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
    protected string $model = Product::class;

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
    public $products = ['quantity' => [], 'selected' => []];

    protected function columns(): array
    {
        return [
            Column::make(__('Nombre'), 'name')
                ->searchable()
                ->sortable(),
            Column::make(__('Stock'), 'stockInGrams'),
            Column::make(__('Cantidad'), 'id')
                ->displayUsing(function (mixed $id) {

                    $disabled = !in_array("" . $id, $this->selected);

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

    public function saveQuantity($productId, $quantity)
    {
        $this->products['quantity'][$productId] = $quantity;
    }

    protected function canSelect(): bool
    {
        $this->products['selected'] = $this->selected;
        return true;
    }
}
