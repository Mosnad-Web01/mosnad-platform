<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class JobOpportunity extends Model
{
    /** @use HasFactory<\Database\Factories\JobOpportunityFactory> */
    use HasFactory;
    public function applicants(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'job_opportunity_applies')
                    ->withTimestamps(); // Tracks the applied time
    }

    // Define the data type of the 'end_date' column
    protected $casts = [
        'end_date' => 'date',
    ];
}
