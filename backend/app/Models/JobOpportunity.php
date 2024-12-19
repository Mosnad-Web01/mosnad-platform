<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class JobOpportunity extends Model
{
    /** @use HasFactory<\Database\Factories\JobOpportunityFactory> */
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'required_skills',
        'experience',
        'position_level',
        'other_criteria',
        'imgurl',
        'end_date',
        'is_approved',
    ];
    public function applicants(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'job_opportunity_applies')
            ->withTimestamps(); // Tracks the applied time
    }


    protected $casts = [
        'end_date' => 'date',
    ];
}
