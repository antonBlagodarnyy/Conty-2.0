<?php

namespace App\Livewire\Product;

use Livewire\Component;

use Livewire\Attributes\Reactive;
use App\Models\Product;

class EditProduct extends Component
{
    #[Reactive]
    public $editedProductId;
    public $newName, $newPrice, $newStockInGrams;
    protected $name, $price, $stockInGrams;

    public function boot()
    {
        $product = Product::find($this->editedProductId);
        if ($product) {
            $this->name = $product->name;
            $this->price = $product->price;
            $this->stockInGrams = $product->stockinGrams;
        }
    }

    public function save()
    {
        $product = Product::find($this->editedProductId);
        if ($this->newName) {
            $product->name = $this->newName;
        }
        if ($this->newPrice) {
            $product->price = $this->newPrice;
        }
        if ($this->newStockInGrams) {
            $product->stockInGrams = $this->newStockInGrams;
        }
  

        if ($product->save()) {
            $this->js('window.location.reload()');
        } else {
            session()->flash('message', 'El producto no se ha podido editar.');
        }
    }

    public function render()
    {
        return view('livewire.product.edit-product');
    }
}
