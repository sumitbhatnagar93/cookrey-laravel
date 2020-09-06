<?php

namespace App\Http\Controllers\Api\v1\vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Sodium\add;

class Product extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //Auth layer for product pages
        //$this->middleware('auth');
        $this->middleware('cors');
    }


    public function addProductView()
    {
        $data = DB::table('services')->get();
        return view('vendors/add-product', $data);
    }

    public function onProductSubmit(Request $request)
    {
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $picture = date('His') . '-' . $filename;
            $data = $request->all();
            $file->move(public_path('/images/restaurants/' . $data['provider_id'] . '/food-images/'), $picture);
            $data['image'] = $picture;
            $extra = array();
            foreach ($data['addOnTitle'] as $key => $addonTitle) {
                $extra[$key]['title'] = $addonTitle;
                $tempAddon = $data[($key + 1) . '_addon'];
                $tempAddonPrice = $data[($key + 1) . '_addonPrice'];
                unset($data[($key + 1) . '_addon']);
                unset($data[($key + 1) . '_addonPrice']);
                foreach ($tempAddon as $subkey => $addon) {
                    $extra[$key]['addon'][$subkey]['name'] = $addon;
                    $extra[$key]['addon'][$subkey]['price'] = $tempAddonPrice[$subkey];
                }
            }
            unset($data['addOnTitle']);
            $data['extra'] = json_encode($extra);
            $postedData = DB::table('product')->insert($data);
            if ($postedData) {
                return response()->json($data);
            } else {
                return response()->json(["message" => "Something went wrong"], 500);
            }
        } else {
            return response()->json(["message" => "Select image first."], 500);
        }
//        $data = $request->all();
//        $extra = array();
//        foreach ($data['addOnTitle'] as $key => $addonTitle) {
//            $extra[$key]['title'] = $addonTitle;
//            foreach ($data[($key+1).'_addon'] as $subkey => $addon) {
//                    $extra[$key]['addon'][$subkey]['name'] = $addon;
//                    $extra[$key]['addon'][$subkey]['price'] = $data[($key+1).'_addonPrice'][$subkey];
//            }
//        }
//        return response()->json($extra);
    }

    public function getProductById($providerId)
    {
        $data = DB::table('product')->where('provider_id', $providerId)->get();
        if ($data) {
            return response()->json($data, 200);
        } else {
            return response()->json(["message" => "Something went wrong"], 500);
        }
    }

    public function getSingleProductById($productID)
    {
        $data = DB::table('product')->where('id', $productID)->get();
        if ($data) {
            return response()->json($data, 200);
        } else {
            return response()->json(["message" => "Something went wrong"], 500);
        }
    }
}
