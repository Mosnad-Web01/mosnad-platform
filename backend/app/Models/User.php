<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

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
        'phone_number',
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
    
}
