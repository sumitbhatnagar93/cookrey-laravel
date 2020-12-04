<?php

namespace App\Http\Controllers\Api\v1\vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddFoodService extends Controller
{
    public function __construct()
    {
        $this->middleware('cors');
    }

    public function updateVendorView($id)
    {
        return view('vendors/add-service', ['action' => $id]);
    }

    public function addServiceView(Request $request)
    {

        if (empty($request->all())) {
            return view('vendors/add-service');
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

                unset($data['old_image']);
                unset($data['old_adhar_pan']);
                unset($data['old_fssai_certificate']);
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
        $data = DB::table('services')->where('business_type', 'tiffin_service')->get();
        return response()->json($data);
    }

    public function getOtherVendors()
    {
        $data = DB::table('services')->where('business_type', 'restaurant')->get();
        return response()->json($data);
    }

    public function viewVendors()
    {
        return view('vendors/vendors');
    }

    public function getVendorById($providerId)
    {
        $data = DB::table('services')->where('provider_id', $providerId)->get();
        return response()->json($data);
    }

    public function updateVendorController(Request $request)
    {

        $data = $request->all();
        $providerID = $data['provider_id'];
        $uploadPath = public_path('/images/restaurants/' . $providerID);
        $vendor = DB::table('services')->where('provider_id', $providerID);

        if ($request->hasFile('business_image')) {
            if ($data['old_image']) {
                unlink($uploadPath . '/' . $data['old_image']);
            }
            $file = $request->file('business_image');
            $filename = $file->getClientOriginalName();
            $picture = $providerID . '-' . $filename;
            $file->move($uploadPath, $picture);
            $data['business_image'] = $picture;
        } else {
            $data['business_image'] = $data['old_image'];
        }

        if ($request->hasFile('adhar_pan')) {
            if ($data['old_adhar_pan']) {
                unlink($uploadPath . '/' . $data['old_adhar_pan']);
            }
            $adharFileRequestFile = $request->file('adhar_pan');
            $adharFileOriginalName = $adharFileRequestFile->getClientOriginalName();
            $adharFile = $providerID . '-' . $adharFileOriginalName;
            $adharFileRequestFile->move($uploadPath, $adharFile);
            $data['adhar_pan'] = $adharFile;
        } else {
            $data['adhar_pan'] = $data['old_adhar_pan'];
        }

        if ($request->hasFile('fssai_certificate')) {
            if ($data['old_fssai_certificate']) {
                unlink($uploadPath . '/' . $data['old_fssai_certificate']);
            }
            $fssaiFileRequestFile = $request->file('fssai_certificate');
            $fssaiFileOriginalName = $fssaiFileRequestFile->getClientOriginalName();
            $fssaiFile = $providerID . '-' . $fssaiFileOriginalName;
            $fssaiFileRequestFile->move($uploadPath, $fssaiFile);
            $data['fssai_certificate'] = $fssaiFile;
        } else {
            $data['fssai_certificate'] = $data['old_fssai_certificate'];
        }

        unset($data['old_image']);
        unset($data['old_adhar_pan']);
        unset($data['old_fssai_certificate']);
        $vendor->update($data);
        if ($vendor) {
            return response()->json($data, 200);
        } else {
            return response()->json(["message" => "Something went wrong"], 500);
        }
    }

    public function deleteVendorController($providerId)
    {
        $result = DB::table('services')->where('provider_id', $providerId)->delete();
        return redirect('vendors');
    }

    public function addSubscription(Request $request)
    {
        $data = $request->all();
        $postedData = DB::table('user_subscribtion')->insert($data);
        if ($postedData) {
            return response()->json($data);
        } else {
            return response()->json(["message" => "Something went wrong"]);
        }
    }

    public function cancelSubsDate(Request $request)
    {
        $data = $request->all();
        $postedData = DB::table('user_subscribtion')->where('userId', $data['userId'])->update($data);
        if ($postedData) {
            return response()->json($data);
        } else {
            return response()->json(["message" => "Something went wrong"]);
        }
    }

    public function createOrder(Request $request)
    {
        $data = $request->all();
        $data['order_id'] = $this->createOrderID(10);
        $postedData = DB::table('orders')->insert($data);
        if ($postedData) {
            return response()->json($data);
        } else {
            return response()->json(["message" => "Something went wrong"]);
        }
    }

    public function createOrderID($n)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return $randomString;
    }
    public function getOrderById($id){
        $data = DB::table('orders')->where('order_id', $id)->get();
        if (!empty($data)){
            $vendorData = DB::table('services')->where('provider_id', $data[0]->vendor_id)->get();
            $data[0]->vendor_name = $vendorData[0]->business_name;
            $data[0]->vendor_address = $vendorData[0]->business_address;
            return response()->json($data);
        }else{
            return response()->json(["message" => "Something went wrong"]);
        }
    }
    public function getOrderByUserId($id){
        $data = DB::table('orders')->where('user_id', $id)->get();
        if (!empty($data)){
            $vendorData = DB::table('services')->where('provider_id', $data[0]->vendor_id)->get();
            $data[0]->vendor_name = $vendorData[0]->business_name;
            $data[0]->vendor_address = $vendorData[0]->business_address;
            return response()->json($data);
        }else{
            return response()->json(["message" => "Something went wrong"]);
        }
    }
}
