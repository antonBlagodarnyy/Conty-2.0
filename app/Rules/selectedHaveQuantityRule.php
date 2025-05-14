<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class selectedHaveQuantityRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
        foreach ($value['selected'] as $selected) {
            //Validamos que todos los productos tengan una cantidad
            if (!isset($value['quantity'][intval($selected)]) || $value['quantity'][intval($selected)] == "") {
                $fail('Todos los productos seleccionados deben tener una cantidad.');
            }
        }
      
    }
}
