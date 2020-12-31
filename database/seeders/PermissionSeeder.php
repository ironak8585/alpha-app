<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Artisan::call('cache:clear');
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = Config::get('permissions');
        $data = [];
        foreach ($permissions as $p) {
            $data = [
                'name' => $p[0],
                'guard_name' => $p[1],
                'description' => $p[2],
            ];
            Permission::create($data);
        }
    }
}
