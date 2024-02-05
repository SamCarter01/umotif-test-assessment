<?php

namespace App\JsonApi\V1\Subjects;

use Illuminate\Http\Request;
use LaravelJsonApi\Core\Resources\JsonApiResource;

class SubjectResource extends JsonApiResource
{

    /**
     * Get the resource's attributes.
     *
     * @param Request|null $request
     * @return iterable
     */
    public function attributes($request): iterable
    {
        return [
            'id' => $this->id,  
            'first_name' => $this->first_name,
            'date_of_birth' => $this->date_of_birth,
            'frequency' => $this->frequency->value(),
            'daily_frequency' => $this->when(isset($this->daily_frequency), $this->daily_frequency?->value()),
            'cohort' => $this->cohort,
            'eligibility_confirmation' =>  $this->when($request?->isMethod('post'), $this->eligibility_confirmation()),
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
        ];
    }

    /**
     * Get the resource's relationships.
     *
     * @param Request|null $request
     * @return iterable
     */
    public function relationships($request): iterable
    {
        return [
            // @TODO
        ];
    }
}
