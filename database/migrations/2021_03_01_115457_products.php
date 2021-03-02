<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Products extends Migration
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
        Schema::dropIfExists('products');

        /*
         * Create table and add columns
         */
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('provider_id', 255)->unique();
            $table->text('title')->nullable(true);
            $table->text('image')->nullable(true);
            $table->text('description')->nullable(true);
            $table->text('price')->nullable(true);
            $table->text('type')->nullable(true);
            $table->longText('food_type')->nullable(true);
            $table->text('rating')->nullable(true);
            $table->longText('extra')->nullable(true);
            $table->text('variant')->nullable(true);
            $table->longText('product_type')->nullable(true);
            $table->text('product_meal')->nullable(true);
            $table->text('haveAddOns')->nullable(true);
            $table->text('created_at');
            $table->text('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
