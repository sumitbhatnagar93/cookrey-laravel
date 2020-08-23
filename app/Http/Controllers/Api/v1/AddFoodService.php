<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddFoodService extends Controller
{
    public function __construct()
    {
        $this->middleware('cors');
    }

    public function addServiceView(Request $request)
    {

        if (empty($request->all())) {
            return view('add-service');
        } else {
            $providerID = 'p' . date('His');
            $uploadPath = public_path('/images/restaurants/' . $providerID);

            $data = $request->all();
            if ($request->hasFile('business_image')) {
                $file = $request->file('business_image');
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $picture = $providerID . '-' . $filename;
                $file->move($uploadPath, $picture);
                $data['business_image'] = $picture;

                if ($request->hasFile('adhar_pan')) {
                    $adharFileRequestFile = $request->file('adhar_pan');
                    $adharFileOriginalName = $adharFileRequestFile->getClientOriginalName();
                    $adharFileExtension = $adharFileRequestFile->getClientOriginalExtension();
                    $adharFile = $providerID . '-' . $adharFileOriginalName;
                    $adharFileRequestFile->move($uploadPath, $adharFile);
                    $data['adhar_pan'] = $adharFile;
                } else {
                    $data['adhar_pan'] = '';
                }

                if ($request->hasFile('fssai_certificate')) {
                    $fssaiFileRequestFile = $request->file('fssai_certificate');
                    $fssaiFileOriginalName = $fssaiFileRequestFile->getClientOriginalName();
                    $fssaiFileExtension = $fssaiFileRequestFile->getClientOriginalExtension();
                    $fssaiFile = $providerID . '-' . $fssaiFileOriginalName;
                    $fssaiFileRequestFile->move($uploadPath, $fssaiFile);
                    $data['fssai_certificate'] = $fssaiFile;
                } else {
                    $data['fssai_certificate'] = '';
                }

                $data['provider_id'] = $providerID;
                $postedData = DB::table('services')->insert($data);
                if ($postedData) {
                    return response()->json($data);
                } else {
                    return response()->json(["message" => "Something went wrong"]);
                }
            } else {
                return response()->json(["message" => "Select image first."], 500);
            }

        }
    }

    public function getVendors()
    {
        $data = DB::table('services')->get();
        return response()->json($data);
    }

    public function getVendorById($providerId)
    {
        $data = DB::table('services')->where('provider_id', $providerId)->get();
        return response()->json($data);
    }
}
