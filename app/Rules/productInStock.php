<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\Product;

class productInStock implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //Recorremos los productos seleccionados
        foreach ($value['selected'] as $selected) {
          
            if (isset($value['quantity'][intval($selected)])) {
                $product = Product::find($selected);

                //Validamos que la cantidad seleccionada exista en stock
                if ($product->stockInGrams < $value['quantity'][intval($selected)]) {
                    $fail('No hay suficiente stock.');
                }
            }
        }
    }
}
