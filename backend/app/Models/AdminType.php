<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class AdminType extends Model
{
    protected $fillable = ['name', 'description'];

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'admin_type_permission');
    }

    // AdminType.php
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_admin_types', 'admin_type_id', 'user_id');
    }
}
