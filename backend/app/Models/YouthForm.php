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
        'name',
        'city',
        'address',
        'birth_date',
        'phone',
        'is_it_graduate',
        'job_interest',
        'motivation',
        'career_goals',
        'project_ideas',
        'has_workshops',
        'has_coding_experience',
        'knows_other_languages',
        'creative_problem_solving',
        'website_vs_webapp',
        'usability_steps',
        'additional_info',
        'document',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
