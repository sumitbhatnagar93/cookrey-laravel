<?php

namespace App\Http\Controllers\Api\v1\vendor;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Tiffin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $this->middleware('auth');
        $this->middleware('cors');
    }


    public function addProductView()
    {
        $data = DB::table('services')->get();
        return view('vendors/add-product', $data);
    }

    public function updateProductView($productId)
    {
        $data = Service::where('user_id', Auth::id())->get()->toArray();
        return view('vendors/add-product', ['productID' => $productId, 'vendorID' => $data[0]['provider_id']]);
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
            if (isset($data['productItem'])) {
                $data['product_meal'] = implode(',', $data['productItem']);
                unset($data['productItem']);
            }
            if (isset($data['haveAddOns'])) {
                $extra = array();
                foreach ($data['addOnTitle'] as $key => $addonTitle) {
                    $extra[$key]['title'] = $addonTitle;
                    $tempAddon = $data[($key + 1) . '_addon'];
                    $tempAddonPrice = $data[($key + 1) . '_addonPrice'];
                    unset($data[($key + 1) . '_addon']);
                    unset($data[($key + 1) . '_addonPrice']);
                    foreach ($tempAddon as $subkey => $addon) {
                        $extra[$key]['addon'][$subkey]['name'] = $addon;
                        if ($tempAddonPrice[$subkey]) {
                            $extra[$key]['addon'][$subkey]['price'] = $tempAddonPrice[$subkey];
                        } else {
                            $extra[$key]['addon'][$subkey]['price'] = 0;
                        }
                    }
                }
                unset($data['addOnTitle']);
                $data['extra'] = json_encode($extra);
            }
            if (!empty($data['product_type']) && ($data['product_type'] == 'variable')) {
                $data['price'] = null;
                $variant = array();
                foreach ($data['variantName'] as $key => $value) {
                    $variant[$key]['name'] = $value;
                    $variant[$key]['price'] = $data['variantPrice'][$key];
                }
                $data['variant'] = json_encode($variant);
            }
            unset($data['variantName']);
            unset($data['variantPrice']);
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

    public function getProductByVendorId($providerId)
    {
        $data = Tiffin::where('vendor_id', $providerId)->get();
        if ($data) {
            return response()->json($data, 200);
        } else {
            return response()->json(["message" => "Something went wrong"], 500);
        }
    }

    public function getSubsProductById($providerId)
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
        $data = DB::table('tiffins')->where('id', $productID)->get();
        if ($data) {
            return response()->json($data, 200);
        } else {
            return response()->json(["message" => "Something went wrong"], 500);
        }
    }

    public function updateProductInfo(Request $request)
    {
        $data = $request->all();
        $updatedData = $data;
        $updatedData['in_the_box'] = json_encode($data['in_the_box']);
        $product = Tiffin::where(['id' => $data['id']])->update($updatedData);
        if ($product) {
            return response()->json(['responseType' => 'success', 'message' => 'product Updated!!']);
        } else {
            return response()->json(['responseType' => 'error', 'message' => 'Something went wrong!']);
        }
    }

    public function onTiffinProductSubmit(Request $request)
    {
        $data = $request->all();
        $temp = $data['in_the_box'];
        unset($data['in_the_box']);
        $data['in_the_box'] = json_encode($temp);
        $postedData = DB::table('tiffins')->insert($data);
        if ($postedData) {
            return response()->json($data);
        } else {
            return response()->json(["message" => "Something went wrong"], 500);
        }
    }

}
