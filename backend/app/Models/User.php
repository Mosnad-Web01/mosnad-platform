<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'status' => 'string',
        ];
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function isAdmin()
    {
        // return $this->role && $this->role->name === 'admin';
        return $this->role_id === 1;
    }

    public function isCompany()
    {
        // return $this->role && $this->role->name === 'company';
        return $this->role_id === 2;
    }

    public function isStudent()
    {
        // return $this->role && $this->role->name === 'student';
        return $this->role_id === 3;
    }
    public function bootcamp()
    {
        return $this->belongsTo(Bootcamp::class);
    }

      // Relationship for job opportunities created by the user
      public function jobOpportunities(): HasMany
      {
          return $this->hasMany(JobOpportunity::class);
      }

    public function appliedJobOpportunities(): BelongsToMany
    {
        return $this->belongsToMany(JobOpportunity::class, 'job_opportunity_applies')
            ->withTimestamps(); // Tracks the applied time
    }



    public function companyForm()
    {
        return $this->hasOne(CompanyForm::class);
    }

    public function youthForm()
    {
        return $this->hasOne(YouthForm::class);
    }


     // Profile relationship
     public function profile()
     {
         return $this->hasOne(UserProfile::class);
     }



    // User.php
    public function adminTypes()
    {
        return $this->belongsToMany(AdminType::class, 'user_admin_types', 'user_id', 'admin_type_id');
    }



    public function hasPermission(string $permission): bool
    {
        return $this->adminTypes()
            ->whereHas(
                'permissions',
                fn($query) =>
                $query->where('slug', $permission)
            )->exists();
    }

    public function blog()
    {
        return $this->hasMany(Blog::class);
    }

    public function notifications(): BelongsToMany
    {
        return $this->belongsToMany(Notification::class, 'notification_user')
            ->withTimestamps();
    }

}
