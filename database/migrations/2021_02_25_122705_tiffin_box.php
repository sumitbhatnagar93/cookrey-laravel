<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TiffinBox extends Migration
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
        Schema::dropIfExists('tiffin_box');

        /*
         * Create table and add columns
         */
        Schema::create('tiffin_box', function (Blueprint $table) {
            $table->id();
            $table->text('title')->nullable(true);
            $table->longText('description')->nullable(true);
            $table->text('price')->nullable(true);
            $table->longText('dish')->nullable(true);
            $table->integer('rice')->nullable(true);
            $table->integer('flatbread')->nullable(true);
            $table->longText('extra')->nullable(true);
            $table->text('tiffin_type')->nullable(true);
            $table->text('vendor_id');
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
