<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Orders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->string('userId')->nullable(true);
            $table->string('vendorId')->nullable(true);
            $table->string('productId')->nullable(true);
            $table->string('subId')->index();
            $table->string('payment_mode')->nullable(true);
            $table->string('product_amount')->nullable(true);
            $table->integer('gst_rate')->nullable(true);
            $table->integer('discount_amount')->nullable(true);
            $table->string('coupon_code')->nullable(true);
            $table->text('delivery_address')->nullable(true);
            $table->integer('agreed_policy')->nullable(true);
            $table->integer('order_total')->nullable(true);
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
