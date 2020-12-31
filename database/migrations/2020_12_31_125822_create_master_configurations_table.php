<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Config;

class CreateMasterConfigurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_configurations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->enum('category', Config::get('constants.APP.CONFIG_CATEGORIES'));
            $table->string('name', 64)->unique();
            $table->string('key', 32)->unique();
            $table->string('value', 64);
            $table->enum('type', Config::get('constants.APP.CONFIG_TYPES'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_configurations');
    }
}
