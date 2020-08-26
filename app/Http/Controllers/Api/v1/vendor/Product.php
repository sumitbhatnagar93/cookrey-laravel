<?php

namespace App\Http\Controllers\Api\v1\vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            $extension = $file->getClientOriginalExtension();
            $picture = date('His') . '-' . $filename;
            $data = $request->all();
            $file->move(public_path('/images/restaurants/' . $data['provider_id'] . '/food-images/'), $picture);
            $data['image'] = $picture;
            $postedData = DB::table('product')->insert($data);
            if ($postedData) {
                return response()->json($data);
            } else {
                return response()->json(["message" => "Something went wrong"], 500);
            }
        } else {
            return response()->json(["message" => "Select image first."], 500);
        }
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
}
