<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bootcamp extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'city', 'description', 'features', 'fees', 'payment_terms', 'instructor', 'training_duration', 'main_image', 'additional_images',
    ];

    protected $casts = [
        'additional_images' => 'array',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
    
}
