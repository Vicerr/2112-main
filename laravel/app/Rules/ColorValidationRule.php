<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ColorValidationRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    protected $cssColorKeywords;

    public function __construct(array $cssColorKeywords)
    {
        $this->cssColorKeywords = $cssColorKeywords;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $value = strtolower($value);
        if (!in_array($value, $this->cssColorKeywords)) {
            $fail('The :attribute must be a valid CSS color.');
        }
    }
}
