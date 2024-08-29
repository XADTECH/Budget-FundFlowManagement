<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    const ROLE_FINANCE_MANAGER = 'Finance Manager';
    const ROLE_OPERATION_MANAGER = 'Operation Manager';
    const ROLE_PROJECT_MANAGER = 'Project Manager';
    const ROLE_CLIENT_MANAGER = 'Client Manager';
    const ROLE_ADMIN = 'Admin';
    const ROLE_SUBADMIN = 'SubAdmin';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'first_name',
        'last_name',
        'organization_unit',
        'phone_number',
        'role',
        'permissions',
        'profile_image',
        'nationality',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function roles()
    {
        return [
            self::ROLE_FINANCE_MANAGER,
            self::ROLE_OPERATION_MANAGER,
            self::ROLE_PROJECT_MANAGER,
            self::ROLE_CLIENT_MANAGER,
            self::ROLE_ADMIN,
            self::ROLE_SUBADMIN,
        ];
    }
}
