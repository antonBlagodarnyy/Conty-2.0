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
        foreach ($value['selected'] as $selected) {
          
            if (isset($value['quantity'][intval($selected)])) {
                $product = Product::find($selected);
                if ($product->stockInGrams < $value['quantity'][intval($selected)]) {
                    $fail('Not enough stock');
                }
            }
        }
    }
}
