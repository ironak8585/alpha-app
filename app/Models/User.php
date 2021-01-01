<?php

namespace App\Models;

use App\Traits\UuidCodeTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Config;


class User extends Authenticatable
{
    use UuidCodeTrait;
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * User is super admin or not
     */
    public function isSuperAdmin()
    {
        return $this->hasRole(Config::get('constants.USER.ROLES.SUPER_ADMIN'));
    }
    public function isAdmin()
    {
        return $this->isSuperAdmin() || $this->hasRole(Config::get('constants.USER.ROLES.ADMIN'));
    }
}
