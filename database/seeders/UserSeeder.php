<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new User();
        $admin->name = 'Super Admin';
        $admin->code = Str::uuid();
        $admin->email = 'sa@email.com';
        $admin->password = Hash::make('simple');
        $admin->save();
        $admin->assignRole(Config::get('constants.USER.ROLES.SUPER_ADMIN'));

        $roles = Config::get('constants.USER.DEFAULT_ROLES');
        foreach ($roles as $name => $desc) {
            //get role
            $role = Role::where('name', $name)->first();

            //create user
            $user = new User();
            $user->name = $desc;
            $user->code  = Str::uuid();
            $user->email = strtolower($name) . '@email.com';
            $user->password = Hash::make('simple');
            $user->save();
            $user->assignRole($role->name);
        }
    }
}
