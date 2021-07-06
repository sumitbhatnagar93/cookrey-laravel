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
        $vendorID = Str::random(10);
        DB::table('services')->insertGetId([
            'provider_id' => $vendorID,
            'user_id' => 2,
            'business_name' => Str::random(10),
            'business_owner_name' => Str::random(10),
            'business_owner_email' => Str::random(10) . '@gmail.com',
            'business_owner_contact' => 9495839334,
            'is_business_owner' => 'yes',
            'business_image' => 'placeholder.jpg',
            'business_city' => Str::random(10),
            'business_address' => Str::random(10),
            'postal_code' => 12345,
            'description' => Str::random(10),
            'is_gstin_number' => 'yes',
            'gstin_number' => 23432534344,
            'fssai_registered_name' => Str::random(10),
            'fssai_address' => Str::random(20),
            'adhar_pan' => Null,
            'fssai_certificate' => Null,
            'rating' => 0,
            'lat' => '29.8542626',
            'lng' => '77.8880002',
            'business_type' => 'tiffin_service',
        ]);

        DB::table('tiffins')->insert([
            'title' => 'Classic Tiffins',
            'description' => Str::random(10),
            'price' => 150,
            'in_the_box' => '["Rice", "Roti", "Dal", "Matter Paneer"]',
            'extra' => Null,
            'veg_non_veg' => 'veg',
            'vendor_id' => $vendorID
        ]);
    }
}
