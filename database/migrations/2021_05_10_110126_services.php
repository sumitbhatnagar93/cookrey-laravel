<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Services extends Migration
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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('provider_id', 255)->unique();
            $table->integer('user_id')->index();
            $table->string('business_name')->nullable(true);
            $table->string('business_owner_name')->nullable(true);
            $table->string('business_owner_email')->nullable(true);
            $table->string('business_owner_contact')->nullable(true);
            $table->string('is_business_owner')->nullable(true);
            $table->text('business_image')->nullable(true);
            $table->string('business_city')->nullable(true);
            $table->text('business_address')->nullable(true);
            $table->string('postal_code')->nullable(true);
            $table->text('description')->nullable(true);
            $table->string('is_gstin_number')->nullable(true);
            $table->string('gstin_number')->nullable(true);
            $table->string('fssai_registered_name')->nullable(true);
            $table->text('fssai_address')->nullable(true);
            $table->string('adhar_pan')->nullable(true);
            $table->string('fssai_certificate')->nullable(true);
            $table->string('rating')->nullable(true);
            $table->string('lat')->nullable(true);
            $table->string('lng')->nullable(true);
            $table->text('business_type')->nullable(true);
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
        Schema::dropIfExists('services');
    }
}
