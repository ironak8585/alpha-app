<?php

namespace App\Models\Admin;

use App\Scopes\OrderScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Spatie\Permission\Models\Role;

class MyRole extends Role
{

    /**
     * Get role names
     */
    public static function getRoleNames()
    {
        $roles = Role::where('name', '!=',  Config::get('constants.USER.ROLES.SUPER_ADMIN'))
            ->get()
            ->pluck('name', 'name');
        return $roles;
    }
}
