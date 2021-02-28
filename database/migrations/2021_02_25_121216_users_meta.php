<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UsersMeta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
         * Check if table already exist
         */
        Schema::dropIfExists('users_meta');

        /*
         * Create table and add columns
         */
        Schema::create('users_meta', function (Blueprint $table) {
            $table->id();
            $table->text('username')->nullable(true);
            $table->text('firstName')->nullable(true);
            $table->text('lastName')->nullable(true);
            $table->text('photo')->nullable(true);
            $table->longText('address')->nullable(true);
            $table->integer('active')->nullable(true);
            $table->integer('is_member')->nullable(true);
            $table->text('membership_type')->nullable(true);
            $table->text('business_type')->nullable(true);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_meta');
    }
}
