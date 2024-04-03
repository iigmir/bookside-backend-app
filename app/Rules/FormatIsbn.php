<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class FormatIsbn implements ValidationRule
{
    private function format_isbn($isbn) {
        // Remove any non-digit characters from the ISBN
        $cleaned_isbn = preg_replace("/[^0-9]/", "", $isbn);
        return $cleaned_isbn;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $isbn = $this->format_isbn($value);
        if( strlen($isbn) != 10 && strlen($isbn) != 13 ) {
            $fail("The ISBN must be 10 or 13.");
        }
        return;
    }
}
