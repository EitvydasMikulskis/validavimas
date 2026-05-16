<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidPhoneNumber implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Pašaliname tarpus ir brūkšnelius
        $phone = preg_replace('/[\s\-]+/', '', $value);

        // Lietuvos telefono numerio tikrinimas
        if (!preg_match('/^(\+3706\d{7}|86\d{7}|06\d{7})$/', $phone)) {
            $fail('Telefono numeris yra neteisingas.');
        }
    }
}