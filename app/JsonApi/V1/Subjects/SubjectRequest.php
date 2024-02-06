<?php

namespace App\JsonApi\V1\Subjects;

use Illuminate\Validation\Rule;
use LaravelJsonApi\Laravel\Http\Requests\ResourceRequest;
use LaravelJsonApi\Validation\Rule as JsonApiRule;
use App\Enums\{Frequency ,DailyFrequency};
use App\Rules\DailyFrequencyRule;

class SubjectRequest extends ResourceRequest
{

    /**
     * Get the validation rules for the resource.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string'],
            'date_of_birth' => ['date'],
            'frequency' => ['required', Rule::enum(Frequency::class)],
            'daily_frequency' => [new DailyFrequencyRule],
            'cohort' => ['prohibited'],
        ];
    }
}
