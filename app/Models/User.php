<?php

namespace App\Models;

use App\Traits\UuidCodeTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Config;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
        'phone'
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
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'email_verified_at' => 'datetime',
        'logged_at' => 'datetime',
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

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = Str::title($value);
    }
    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = Str::lower($value);
    }

    /**
     * Register
     *
     * @param array $data     
     * @return User
     */
    public static function register($data)
    {

        DB::beginTransaction();
        //create user
        try {
            $user = User::create($data);
        } catch (\Throwable $th) {
            DB::rollback();
            throw new Exception("User create : " . $th->getMessage(), 1);
        }
        //assigne roles
        try {
            $user->assignRole(Config::get('constants.USER.ROLES.GUEST'));
        } catch (\Throwable $th) {
            DB::rollback();
            throw new Exception("Role assignment : " . $th->getMessage(), 1);
        }

        DB::commit();
        return $user;
    }

    /**
     * Create new user
     *
     * @param array $data
     * @param array $roles
     * @return User
     */
    public static function add($data, $roles)
    {

        DB::beginTransaction();
        //create user
        try {
            $user = User::create($data);
        } catch (\Throwable $th) {
            DB::rollback();
            throw new Exception("User create : " . $th->getMessage(), 1);
        }
        //assigne roles
        try {
            $roles = $roles ? $roles : [];
            $user->assignRole($roles);
        } catch (\Throwable $th) {
            DB::rollback();
            throw new Exception("Role assignment : " . $th->getMessage(), 1);
        }

        DB::commit();
        return $user;
    }

    /**
     * Update user
     *
     * @param array $data
     * @return User
     */
    public function safeUpdate($data)
    {
        $this->fill($data);
        try {
            $this->save();
        } catch (\Throwable $th) {
            throw new Exception("User update : " . $th->getMessage(), 1);
        }
    }

    /**
     * Update user role
     *
     * @param string $prevRole
     * @param string $newRole
     * @return void
     */
    public function updateRole($prevRole, $newRole)
    {
        //update role
        try {
            $this->removeRole($prevRole);
            $this->assignRole($newRole);
        } catch (\Throwable $th) {
            throw new Exception("Role assignment : " . $th->getMessage(), 1);
        }
    }
}
