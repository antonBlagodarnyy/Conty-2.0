<?php

namespace App\Livewire\Product;

use Livewire\Component;

use Livewire\Attributes\Reactive;
use App\Models\Product;

class EditProduct extends Component
{
    #[Reactive]
    public $editedProductId;
    public $newName, $newPrice, $newStockInGrams, $newNetContent;
    protected $name, $price, $stockInGrams, $netContent;

    public function boot()
    {
        $product = Product::find($this->editedProductId);
        if ($product) {
            $this->name = $product->name;
            $this->price = $product->price;
            $this->stockInGrams = $product->stockInGrams;
            $this->netContent = $product->netContent;
        }
    }

    public function save()
    {
        $product = Product::find($this->editedProductId);
        if ($this->newName !== null) {
            $product->name = $this->newName;
        }
        if ($this->newPrice !== null) {
            $product->price = $this->newPrice;
        }
        if ($this->newNetContent !== null && intval($this->newNetContent) >= 0) {
            $product->netContent = $this->newNetContent;
        }
        //TODO improve the feedback on negatives
        if ($this->newStockInGrams !== null && intval($this->newStockInGrams) >= 0) {
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
