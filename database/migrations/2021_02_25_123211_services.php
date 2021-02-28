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
         * Check if table already exist
         */
        Schema::dropIfExists('services');

        /*
         * Create table and add columns
         */
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->text('provider_id')->nullable(true);
            $table->text('business_name')->nullable(true);
            $table->text('business_owner_name')->nullable(true);
            $table->text('business_owner_email')->nullable(true);
            $table->text('business_owner_contact')->nullable(true);
            $table->text('is_business_owner')->nullable(true);
            $table->longText('business_image')->nullable(true);
            $table->text('business_city')->nullable(true);
            $table->longText('business_address')->nullable(true);
            $table->text('postal_code')->nullable(true);
            $table->longText('description')->nullable(true);
            $table->text('is_gstin_number')->nullable(true);
            $table->text('gstin_number')->nullable(true);
            $table->text('fssai_registered_name')->nullable(true);
            $table->longText('fssai_address')->nullable(true);
            $table->text('adhar_pan')->nullable(true);
            $table->text('fssai_certificate')->nullable(true);
            $table->text('business_map_lat')->nullable(true);
            $table->text('business_map_lng')->nullable(true);
            $table->text('rating')->nullable(true);
            $table->text('lat')->nullable(true);
            $table->text('lng')->nullable(true);
            $table->text('business_type')->nullable(true);
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
        Schema::dropIfExists('services');
    }
}
