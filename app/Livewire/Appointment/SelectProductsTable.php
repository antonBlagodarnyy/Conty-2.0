<?php

namespace App\Livewire\Appointment;

use App\Models\Product;
use Livewire\Attributes\Modelable;
use RamonRietdijk\LivewireTables\Livewire\LivewireTable;
use RamonRietdijk\LivewireTables\Columns\Column;

class SelectProductsTable extends  LivewireTable
{
    protected string $model = Product::class;

    #[Modelable]
    public $selection = [];



    protected function columns(): array
    {
        return [
            Column::make(__('Nombre'), 'name')
                ->searchable()
                ->sortable(),
            Column::make(__('Stock'), 'stockInGrams'),
            Column::make(__('Cantidad'), 'id')
                ->displayUsing(function (mixed $id) {
                    $disabled = !in_array("".$id, $this->selected);
                    return view('livewire.appointment.input-product', [
                        'productId' => $id,
                        'disabled' => $disabled
                    ]);
                })->asHtml(),
        ];
    }

    public function saveQuantity($productId, $quantity)
    {
        $this->selection[$productId] = $quantity;
    }

    protected function canSelect(): bool
    {
        return true;
    }
}
