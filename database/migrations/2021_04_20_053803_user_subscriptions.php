<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserSubscriptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_subscriptions', function (Blueprint $table) {
            $table->id()->unique();
            $table->string('userId')->nullable(true);
            $table->string('vendorId')->nullable(true);
            $table->string('productId')->nullable(true);
            $table->string('validity')->nullable(true);
            $table->string('start_date')->nullable(true);
            $table->string('end_date')->nullable(true);
            $table->text('serve_time')->nullable(true);
            $table->text('cancel_dates')->nullable(true);
            $table->longText('addon')->nullable(true);
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
        /*
         * Check if table already exist
         */
        Schema::dropIfExists('user_subscriptions');
    }
}
