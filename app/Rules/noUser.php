<?php

namespace App\Rules;

use App\Models\User;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class noUser implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
        $existingUser = User::where('email', $value)->exists();
        if(!$existingUser) $fail('Ese usuario no existe.');
    }
}
