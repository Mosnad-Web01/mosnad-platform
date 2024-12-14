<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YouthForm extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'gender',
        'is_it_graduate',
        'job_interest',
        'motivation',
        'career_goals',
        'project_ideas',
        'has_workshops',
        'workshop_clarify',
        'has_coding_experience',
        'coding_clarify',
        'knows_other_languages',
        'languages',
        'creative_problem_solving',
        'website_vs_webapp',
        'usability_steps',
        'additional_info',
        'document',
        'user_id',
    ];

    protected $casts = [
        'languages' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
