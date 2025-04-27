<?php

namespace App\Livewire\Product;

use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Reactive;
use App\Models\Product;

class EditProduct extends Component
{
    #[Reactive]
    public $editedProductId;

    #[Validate('required', onUpdate: false)]
    public $newName;
    #[Validate('required|decimal:2', onUpdate: false)]
    public $newPrice;
    #[Validate('required|min:1', onUpdate: false)]
    public $newStockInGrams;
    #[Validate('required|min:1', onUpdate: false)]
    public $newNetContent;


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

        $product->name = $this->newName;
        $product->price = $this->newPrice;
        $product->netContent = $this->newNetContent;
        $product->stockInGrams = $this->newStockInGrams;

        $product->save();

        $this->js('window.location.reload()');
    }

    public function render()
    {
        return view('livewire.product.edit-product');
    }
}
