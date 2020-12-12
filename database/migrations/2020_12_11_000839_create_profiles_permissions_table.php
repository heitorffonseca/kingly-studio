<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles_permissions', function (Blueprint $table) {
            $table->unsignedInteger('profiles_id');
            $table->foreign('profiles_id')->references('id')->on('profiles')->onDelete('cascade');

            $table->unsignedInteger('permissions_id');
            $table->foreign('permissions_id')->references('id')->on('permissions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles_permissions');
    }
}
