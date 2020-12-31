<?php

namespace Database\Seeders;

use App\Models\Master\Configuration;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $config = new Configuration();
        $config->id = Str::uuid();
        $config->category = 'APP';
        $config->name = 'Default Record per Page';
        $config->key = 'records per page';
        $config->value = 20;
        $config->type = 'INT';
        $config->save();
    }
}
