<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UsersFeedback extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
         * Create table and add columns
         */
        Schema::create('users_feedback', function (Blueprint $table) {
            $table->bigIncrements('feedback_id');
            $table->longText('feedback_msg')->nullable(true);
            $table->float('feedback_rating');
            $table->string('vendor_id', 255)->index();
            $table->foreign('vendor_id')->references('provider_id')->on('services')->onDelete('cascade');
            $table->string('user_id');
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
        Schema::dropIfExists('users_feedback');
    }
}
