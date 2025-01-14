<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'status',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'tags',
        'categories',
        'images',
        'user_id',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
