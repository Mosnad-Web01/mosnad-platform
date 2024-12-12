<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
class Permission extends Model
{
    protected $fillable = ['name', 'slug', 'description'];

    public function adminTypes(): BelongsToMany
    {
        return $this->belongsToMany(AdminType::class, 'admin_type_permission');
    }
}
