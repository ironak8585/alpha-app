<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //add super admin
        Role::create(['name' => Config::get('constants.USER.ROLES.SUPER_ADMIN')]);
        $roles = Config::get('constants.USER.DEFAULT_ROLES');
        foreach ($roles as $name => $desc) {
            Role::create([
                'name' => $name,
                'guard_name' => 'web',
            ]);
        }
    }
}
