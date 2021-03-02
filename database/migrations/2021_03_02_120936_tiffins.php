<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Tiffins extends Migration
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
        Schema::dropIfExists('tiffins');

        /*
         * Create table and add columns
         */
        Schema::create('tiffins', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable(true);
            $table->text('description')->nullable(true);
            $table->string('price')->nullable(true);
            $table->longText('in_the_box')->nullable(true);
            $table->longText('extra')->nullable(true);
            $table->string('veg_non_veg')->nullable(true);
            $table->string('vendor_id', 255)->index();
            $table->foreign('vendor_id')->references('provider_id')->on('services')->onDelete('cascade');
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
        //
    }
}
