<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'about',
        'industry',
        'employees',
        'environment',
        'company_website',
        'social_media_link',
        'stage',
        'skills',
        'home_workers',
        'training',
        'training_type',
        'hiring',
        'hiring_skills',
        'remote_hiring_preferences',
        'yemeni_workers',
        'hiring_fears',
        'precondition',
        'additional_notes',
        'user_id',
    ];

    protected $casts = [
        'skills' => 'array',
        'hiring_skills' => 'array',
        'remote_hiring_preferences' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
