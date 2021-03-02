<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class service extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services')->insert([
            'provider_id' => Str::random(10),
            'business_name' => Str::random(10),
            'business_owner_name' => Str::random(10),
            'business_owner_email' => Str::random(10).'@gmail.com',
            'business_owner_contact' => Str::random(10),
            'is_business_owner' => Str::random(10),
            'business_image' => Str::random(10),
            'business_city' => Str::random(10),
            'business_address' => Str::random(10),
            'postal_code' => Str::random(10),
            'description' => Str::random(10),
            'is_gstin_number' => Str::random(10),
            'gstin_number' => Str::random(10),
            'fssai_registered_name' => Str::random(10),
            'fssai_address' => Str::random(20),
            'adhar_pan' => Null,
            'fssai_certificate' => Null,
            'rating' => 0,
            'lat' => '29.8542626',
            'lng' => '77.8880002',
            'business_type' => Str::random(10),
        ]);
    }
}
