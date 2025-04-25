<?php

namespace App\Livewire\Product;

use Livewire\Component;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class AddProduct extends Component
{
    public $name, $price, $stockInGrams, $net_content;

    public function save()
    {

        if (Product::create([
            'name' => $this->name,
            'price' => $this->price,
            'net_content' => $this->net_content,
            'stockInGrams' => $this->stockInGrams,
            'user_id' => Auth::id(),
        ])) {
            session()->flash('message', 'Producto creado');
        }
    }

    public function render()
    {
        return view('livewire.product.add-product');
    }
}
