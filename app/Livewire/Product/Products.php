<?php

namespace App\Livewire\Product;

use Livewire\Component;
use App\Models\Product;


class Products extends Component
{
    //Guardo el producto editado
    public $editedProductId;

    //Declaro los eventos
    public function clearAddForm(){
        $this->dispatch('clear-add-form');
    }
    public function clearEditForm(){
        $this->dispatch('clear-edit-form');
    }

    //Funcion para borrar al producto
    public function deleteProduct($id){
        Product::where('id',$id)->delete();
    }
    public function render()
    {
        return view('livewire.product.products');
    }
}
