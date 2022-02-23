<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFunctionalitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('functionalities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });
        Schema::create('functionality_role', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('functionality_id');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('functionality_id')->references('id')->on('functionalities')->onDelete('cascade');
            $table->unique(['role_id','functionality_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('functionality_role');
        Schema::dropIfExists('functionalities');
    }
}
