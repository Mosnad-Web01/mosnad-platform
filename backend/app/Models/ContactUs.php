<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'phone', 'email', 'message'];

    public function replies()
    {
        return $this->hasMany(Reply::class, 'contact_us_id');
    }
}
