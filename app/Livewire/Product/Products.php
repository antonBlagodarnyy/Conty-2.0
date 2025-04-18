<?php

namespace App\Livewire\Product;

use Livewire\Component;
use App\Models\Product;

//TODO add validation on the forms
class Products extends Component
{
    public $editedProductId;

    public function deleteProduct($id){
        Product::where('id',$id)->delete();
    }
    public function render()
    {
        return view('livewire.product.products');
    }
}
