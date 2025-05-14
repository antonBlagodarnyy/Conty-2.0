<?php

namespace App\Livewire\Product;

use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class AddProduct extends Component
{
    //Las vars del formulario con sus validaciones
    #[Validate('required', onUpdate: false)]
    public $name;
    #[Validate('required|numeric|min:0', onUpdate: false)]
    public $price;
    #[Validate('required|numeric|min:0', onUpdate: false)]
    public $stockInGrams;
    #[Validate('required|numeric|min:1', onUpdate: false)]
    public $net_content;

     //Al limpiar el formulario reinicio las vars
    #[On('clear-add-form')]
    public function clearForm()
    {
        $this->name = "";
        $this->price = "";
        $this->stockInGrams = "";
        $this->net_content = "";
    }

    public function save()
    {

        $this->validate();

        Product::create([
            'name' => $this->name,
            'price' => $this->price,
            'net_content' => $this->net_content,
            'stockInGrams' => $this->stockInGrams,
            'user_id' => Auth::id(),
        ]);

        $this->js('window.location.reload()');
    }

    public function render()
    {
        return view('livewire.product.add-product');
    }
}
