<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Locked;
use Illuminate\Support\Facades\Auth;
use RamonRietdijk\LivewireTables\Livewire\LivewireTable;
use RamonRietdijk\LivewireTables\Columns\Column;
use RamonRietdijk\LivewireTables\Actions\Action;
use RamonRietdijk\LivewireTables\Columns\BooleanColumn;
use Illuminate\Database\Eloquent\Model;


class ProductTable extends LivewireTable
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

    protected function columns(): array
    {
        return [
            Column::make(__('Nombre'), 'name')
                ->searchable()
                ->sortable(),

            Column::make(__('Precio'), 'price')
                ->sortable(),
            Column::make(__('Contenido neto'), 'net_content')
                ->sortable(),
            Column::make(__('Stock en gramos'), 'stockInGrams')
                ->sortable(),
            BooleanColumn::make(__('Disponible'), function (mixed $value, Model $model): bool {
                return $model->stockInGrams > 0;
            })
                ->sortable()

        ];
    }

    protected function actions(): array
    {
        return [
            Action::make(
                __('Eliminar producto'),
                <<<JS
       if( confirm('Seguro que desea eliminar los productos seleccionados?')){
         for (const e of \$wire.selected) {
                \$wire.\$parent.deleteProduct(e);
            }
        window.location.reload();
       }
    JS
            ),
            Action::make(
                __('Añadir producto'),
                <<<JS
                \$flux.modal('add-product').show(); 
            JS
            )
                ->standalone(),

            Action::make(
                __('Editar producto'),
                <<<JS
                    if(\$wire.selected.length>1){
                        alert('Escoja un solo producto para editar.')
                    } else {
                        \$wire.\$parent.\$set('editedProductId',\$wire.selected[0]);
                        \$flux.modal('edit-product').show();
                        
                    }
                    JS
            )
        ];
    }
}
