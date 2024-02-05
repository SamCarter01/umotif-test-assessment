<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\{Frequency, DailyFrequency};

class Subject extends Model
{
    use HasFactory;

    /**
     * @var string[]
    */
    protected $fillable = ['first_name', 'daily_frequency', 'frequency', 'date_of_birth'];

    protected $casts = [
        'frequency' => Frequency::class,
        'daily_frequency' => DailyFrequency::class
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($subject) {
            $subject->assignCohort();
        });
    }

    private function assignCohort()
    {   
        if ($this->isUnder18OnCreation()) {
            return null;
        } else {
            $this->cohort = match ($this->frequency->name) {
                "MONTHLY", "WEEKLY" => 'A',
                "DAILY" => 'B',
                default => null
            };
        }
    }

    public function isUnder18OnCreation()
    {
        return date('Y-m-d', strtotime($this->date_of_birth. ' + 18 years')) > date("Y/d/m");
    }

    private function isOver18OnCreation()
    {
        return !$this-> isUnder18OnCreation();
    }

    /**
     * Get the resource's relationships.
     *
     * @return String
     */
    public function eligibility_confirmation(): string {
        return match ($this->cohort) {
            null => "Participants must be over 18 years of age",
            'A' => "Participant {$this->firstName} is assigned to Cohort A",
            'B' => "Candidate {$this->firstName} is assigned to Cohort B",
            default => "Unknown eligibility status",
        };
        
    }
}
