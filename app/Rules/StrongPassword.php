<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class StrongPassword implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $password = (string) $value;
        if (strlen($password) < 12) $fail('Password must be at least 12 characters.');
        if (!preg_match('/[A-Z]/', $password)) $fail('Password must contain at least one uppercase letter.');
        if (!preg_match('/[a-z]/', $password)) $fail('Password must contain at least one lowercase letter.');
        if (!preg_match('/\\d/', $password)) $fail('Password must contain at least one digit.');
        if (!preg_match('/[^A-Za-z0-9]/', $password)) $fail('Password must contain at least one special symbol.');
    }
}
