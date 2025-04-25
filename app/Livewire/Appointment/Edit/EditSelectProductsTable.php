<?php

namespace App\Livewire\Appointment\Edit;

use App\Models\Product;
use Livewire\Attributes\Modelable;
use Livewire\Attributes\Reactive;
use Livewire\Attributes\On;
use RamonRietdijk\LivewireTables\Livewire\LivewireTable;
use RamonRietdijk\LivewireTables\Columns\Column;

class EditSelectProductsTable extends  LivewireTable
{
    protected string $model = Product::class;

    #[Modelable]
    public $products = ['quantity' => [], 'selected' => []];

    #[Reactive]
    public $productsSelection;

    #[On('updateSelection')]
    public function updateSelection()
    {
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
