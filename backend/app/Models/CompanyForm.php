<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'industry',
        'employees',
        'stage',
        'skills',
        'home_workers',
        'training',
        'hiring',
        'remote_hiring_preferences',
        'additional_notes',
    ];

    protected $casts = [
        'skills' => 'array',
        'hiring' => 'array',
        'remote_hiring_preferences' => 'array',
    ];
}
