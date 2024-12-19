<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'industry',
        'employees',
        'stage',
        'skills',
        'home_workers',
        'training',
        'hiring',
        'remote_hiring_preferences',
        'additional_notes',
        'user_id',
    ];

    protected $casts = [
        'skills' => 'array',
        'remote_hiring_preferences' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
