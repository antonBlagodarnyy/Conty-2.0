<?php

namespace App\Livewire\Appointment;

use App\Models\Product;
use Livewire\Attributes\Modelable;
use RamonRietdijk\LivewireTables\Livewire\LivewireTable;
use RamonRietdijk\LivewireTables\Columns\Column;
use RamonRietdijk\LivewireTables\Columns\ViewColumn;
use Illuminate\Database\Eloquent\Model;

class SelectProductsTable extends  LivewireTable
{
    protected string $model = Product::class;

    #[Modelable]
    public $selection=[];



    protected function columns(): array
    {
        return [
            Column::make(__('Nombre'), 'name')
                ->searchable()
                ->sortable(),
            Column::make(__('Stock'), 'stockInGrams'),
            ViewColumn::make(__('Cantidad'), 'livewire.appointment.input-product')
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
