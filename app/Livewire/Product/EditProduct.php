<?php

namespace App\Livewire\Product;

use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use App\Models\Product;

class EditProduct extends Component
{
    //Contiene el id del producto que se va a editar, reactive por que viene del componente padre
    #[Reactive]
    public $editedProductId;


    public $newName;
    
    public $newPrice;

    public $newStockInGrams;

    public $newNetContent;

    //Los datos anteriores
    protected $name, $price, $stockInGrams, $netContent;

    //Al abrir el modal
    #[On('clear-edit-form')]
    public function clearForm()
    {
        $this->newName = "";
        $this->newPrice = "";
        $this->newStockInGrams = "";
        $this->newNetContent = "";
    }

    public function boot()
    {
        $product = Product::find($this->editedProductId);
        if ($product) {
            $this->name = $product->name;
            $this->price = $product->price;
            $this->stockInGrams = $product->stockInGrams;
            $this->netContent = $product->net_content;
        }
    }

    public function save()
    {
        $this->validate();

        $product = Product::find($this->editedProductId);

        $product->name = $this->newName;
        $product->price = $this->newPrice;
        $product->net_content = $this->newNetContent;
        $product->stockInGrams = $this->newStockInGrams;

        $product->save();

        $this->js('window.location.reload()');
    }

    public function render()
    {
        return view('livewire.product.edit-product');
    }
}
