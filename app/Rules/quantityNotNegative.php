<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class quantityNotNegative implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        foreach ($value['selected'] as $selected) {
            if (array_key_exists("quantity",$value)) {
                if ($value['quantity'][intval($selected)] < 0) {
                    $fail('Todas las cantidades seleccionadas deben ser un valor positivo o 0.');
                }
            }
        }
    }
}
