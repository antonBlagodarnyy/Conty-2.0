<?php

namespace App\Livewire\Product;

use App\Models\Product;
use RamonRietdijk\LivewireTables\Livewire\LivewireTable;
use RamonRietdijk\LivewireTables\Columns\Column;
use RamonRietdijk\LivewireTables\Actions\Action;
use RamonRietdijk\LivewireTables\Columns\BooleanColumn;
use Illuminate\Database\Eloquent\Model;

class ProductTable extends LivewireTable
{
    protected string $model = Product::class;

    protected function columns(): array
    {
        return [
            Column::make(__('Nombre'), 'name')
                ->searchable()
                ->sortable(),
            Column::make(__('Precio'), 'price')
            ->sortable(),
            Column::make(__('Stock en gramos'), 'stockInGrams')
            ->sortable(),
            BooleanColumn::make(__('Disponible'), function (mixed $value, Model $model):bool {
                return $model->stockInGrams;
            })
            ->sortable()
        ];
    }
}
