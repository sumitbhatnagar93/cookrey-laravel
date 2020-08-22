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
            if ($request->hasFile('business_image')) {
                $providerID = 'p'.date('His');
                $file = $request->file('business_image');
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $picture = $providerID . '-' . $filename;


                $adharFile = $request->file('adhar_pan');
                $filename2 = $adharFile->getClientOriginalName();
                $extension = $adharFile->getClientOriginalExtension();
                $picture2 = $providerID . '-' . $filename2;


                $file2 = $request->file('fssai_certificate');
                $filename3 = $file2->getClientOriginalName();
                $extension = $file2->getClientOriginalExtension();
                $picture3 = $providerID . '-' . $filename3;
                $uploadPath = public_path('/images/restaurants/' . $providerID);

                $file->move($uploadPath, $picture);
                $file2->move($uploadPath, $picture2);
                $adharFile->move($uploadPath, $picture3);

                $data = $request->all();
                $data['provider_id'] = $providerID;
                $data['business_image'] = $picture;
                $data['adhar_pan'] = $picture2;
                $data['fssai_certificate'] = $picture3;
                $postedData = DB::table('services')->insert($data);
                if ($postedData) {
                    return response()->json($data);
                } else {
                    return response()->json(["message" => "Something went wrong"]);
                }
            } else {
                return response()->json(["message" => "Select image first."]);
            }

        }
    }

    public function getVendors()
    {
        $data = DB::table('services')->get();
        return response()->json($data);
    }
}
