<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;


    // Define the inverse relationship to contact_us
    public function contactUs()
    {
        return $this->belongsTo(ContactUs::class, 'contact_us_id');
    }
}
