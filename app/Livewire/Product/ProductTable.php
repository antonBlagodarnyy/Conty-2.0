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
    //Selecciono el modelo que usara la tabla
    protected string $model = Product::class;

    //Recojo el id del usuario en una propiedad protegida al inicializar el componente
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

    //Creo las columnas
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

    //Creo las acciones
    protected function actions(): array
    {
        return [
            Action::make(
                __('Eliminar producto'),
                //Uso js
                <<<JS
       if( confirm('Seguro que desea eliminar los productos seleccionados?')){
         for (const e of \$wire.selected) {
            //Lanzo la funcion del componente padre
                \$wire.\$parent.deleteProduct(e);
            }
        window.location.reload();
       }
    JS
            ),
            Action::make(
                __('Añadir producto'),
                <<<JS
                //Muestro el modal
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
                        //Seteo el producto a editar
                        \$wire.\$parent.\$set('editedProductId',\$wire.selected[0]);
                        //Muestro el modal
                        \$flux.modal('edit-product').show();
                        
                    }
                    JS
            )
        ];
    }
}
