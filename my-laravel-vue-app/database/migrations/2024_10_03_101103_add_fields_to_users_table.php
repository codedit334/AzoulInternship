<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('lvl')->nullable();  // Add the level (e.g., education level)
            $table->string('city')->nullable(); // Add city
            $table->enum('sex', ['male', 'female', 'other'])->nullable();  // Add sex as an enum
            $table->string('subject')->nullable();  // Add subject (e.g., teaching subject)
            $table->string('address')->nullable();  // Add address
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['lvl', 'city', 'sex', 'subject', 'address']);
        });
    }
};