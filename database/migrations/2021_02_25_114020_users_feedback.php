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
         * Check if table already exist
         */
        Schema::dropIfExists('users_feedback');

        /*
         * Create table and add columns
         */
        Schema::create('users_feedback', function (Blueprint $table) {
            $table->bigIncrements('feedback_id');
            $table->longText('feedback_msg')->nullable(true);
            $table->float('feedback_rating');
            $table->text('vendor_id');
            $table->text('user_id');
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
        Schema::dropIfExists('users_feedback');
    }
}
