<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserSubscribtion extends Migration
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
        Schema::dropIfExists('user_subscription');

        /*
         * Create table and add columns
         */
        Schema::create('user_subscription', function (Blueprint $table) {
            $table->id();
            $table->text('userId')->nullable(true);
            $table->text('vendorId')->nullable(true);
            $table->text('productId')->nullable(true);
            $table->text('validity')->nullable(true);
            $table->text('start_date')->nullable(true);
            $table->text('end_date')->nullable(true);
            $table->integer('serve_time')->nullable(true);
            $table->longText('addon')->nullable(true);
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
        //
    }
}
