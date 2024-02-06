<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Enums\{Frequency, DailyFrequency};

class DailyFrequencyRule implements DataAwareRule, ValidationRule
{
    /**
     * All of the data under validation.
     *
     * @var array<string, mixed>
     */
    protected $data = [];
 
    // ...
 
    /**
     * Set the data under validation.
     *
     * @param  array<string, mixed>  $data
     */
    public function setData(array $data): static
    {
        $this->data = $data;
 
        return $this;
    }
    
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($this->data['frequency'] !== Frequency::DAILY->value) {
            $fail('The daily frequency can only be passed if the response to the frequency is '.Frequency::DAILY->value().'.');
        } elseif (array_key_exists('daily_frequency', $this->data) && $this->data['daily_frequency'] !== null) {
            $fail('The daily frequency field should not be present when the response to the frequency is not ' . Frequency::DAILY->value() . '.');
        } elseif (DailyFrequency::tryFrom($this->data['daily_frequency']) !== null) {
            $fail('Invalid value for daily frequency.');
        }
    }
}
