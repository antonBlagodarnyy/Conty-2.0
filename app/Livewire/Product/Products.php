<?php

namespace App\Livewire\Product;

use Livewire\Component;
use App\Models\Product;

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
