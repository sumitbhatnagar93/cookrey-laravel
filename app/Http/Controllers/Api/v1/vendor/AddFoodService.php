<?php

namespace App\Http\Controllers\Api\v1\vendor;

use App\Models\Order;
use App\Models\Service;
use App\Models\Tiffin;
use App\Models\UserSubscription;
use Illuminate\Support\Facades\Date;
use Razorpay\Api\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Razorpay\Api\Payment;


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
        $data = Service::with('avgRating', 'servicesProduct')
            ->where('business_type', 'tiffin_service')
            ->get()->toArray();
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

    public function viewVendorsOnFront()
    {
        return view('/vendors-web');
    }

    public function viewSingleVendorsOnFront($id)
    {
        return view('/vendor-single', ['action' => $id]);
    }

    public function getVendorById($providerId)
    {
        $data = Service::where('provider_id', $providerId)->with('usersFeedback')->get()->toArray();
        return response()->json($data);
    }

    public function getVendorByIdWithFeed($providerId)
    {
        $data = Service::where('provider_id', $providerId)->with('usersFeedback', 'avgRating', 'servicesProduct')->get()->toArray();
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
        $checkIfAlreadyExist = UserSubscription::where([['userId', '=', $data['userId']], ['vendorId', '=', $data['vendorId']], ['productId', $data['productId']]])->get()->toArray();
        if ($checkIfAlreadyExist) return response()->json(['responseType' => 'error', 'message' => 'You already subscribed to this plan!']);

        //   if (!$isOrdered) return response()->json(['responseType' => 'error', 'message' => 'Unable to add your subscription!']);
        $postedData = new UserSubscription();
        $postedData->vendorId = $data['vendorId'];
        $postedData->userId = $data['userId'];
        $postedData->productId = $data['productId'];
        $postedData->validity = $data['formData']['validity'];
        $postedData->serve_time = implode(',', $data['formData']['serve_time']);
        $postedData->addon = implode(',', $data['formData']['addon']);
        $startDate = date("Y-m-d");;
        $endDate = null;
        if ($data['formData']['validity'] == 'week') {
            $endDate = date("Y-m-d", strtotime("+1 week"));
        } elseif ($data['formData']['validity'] == 'month') {
            $endDate = date("Y-m-d", strtotime("+1 month"));
        } else {
            $startDate = $data['formData']['start_date'];
            $endDate = $data['formData']['end_date'];
        }
        $postedData->start_date = $startDate;
        $postedData->end_date = $endDate;
        $postedData->save($data);
        //$postedData = DB::table('user_subscribtion')->insert($data);
        if ($postedData) {
            $data['subId'] = $postedData->id;
            $isOrdered = $this->createOrder($data);
            if ($isOrdered) {
                return response()->json(['responseType' => 'success', 'message' => 'Your Subscription Done!']);
            }
        } else {
            return response()->json(['responseType' => 'error', 'message' => 'Something went wrong!']);
        }
    }

    public function cancelSubsDate(Request $request)
    {
        $data = $request->all();
        $postedData = UserSubscription::where('userId', $data['userId'])->update($data);
        if ($postedData) {
            return response()->json($data);
        } else {
            return response()->json(["message" => "Something went wrong"]);
        }
    }

    public function createOrder($data)
    {
        $payment = $this->fetchPayment($data['pay_id']);
        $order = new Order();
        $order->order_id = $data['order_id'];
        $order->userId = $data['userId'];
        $order->vendorId = $data['vendorId'];
        $order->productId = $data['productId'];
        $order->subId = $data['subId'];
        $order->payment_mode = $payment->method;
        $order->product_amount = $data['product_amount'];
        $order->gst_rate = $data['gst_rate'];
        $order->discount_amount = $data['discount_amount'];
        $order->coupon_code = $data['coupon_code'];
        $order->delivery_address = $data['delivery_address'];
        $order->agreed_policy = $data['agreed_policy'];
        $order->order_total = $data['order_total'];
        $order->save();
//        $data = $request->all();
//        $data['order_id'] = $this->createOrderID(10);
//        $postedData = DB::table('orders')->insert($data);
//        if ($postedData) {
//            return response()->json($data);
//        } else {
//            return response()->json(["message" => "Something went wrong"]);
//        }
        return $order;
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

    public function getOrderById($id)
    {
        $data = Order::where([['order_id', '=', $id]])->with('subscription')->get()->toArray();
        //  $data = DB::table('orders')->where('order_id', $id)->get();
        if (!empty($data)) {
            $vendorData = Service::where([['provider_id', '=', $data[0]['vendorId']]])->get()->toArray();
            $data[0]['vendor_name'] = $vendorData[0]['business_name'];
            $data[0]['vendor_address'] = $vendorData[0]['business_address'];
            return response()->json($data);
        } else {
            return response()->json(["message" => "Something went wrong"]);
        }
    }

    public function getOrderByUserId($id)
    {
        $data = Order::where([['userId', '=', $id]])->with('product')->get();
        if (!empty($data)) {
            return response()->json($data);
        } else {
            return response()->json(["message" => "Something went wrong"]);
        }
    }

    public function getOrderByVendorId($id)
    {
        $data = Order::where([['vendorId', '=', $id]])->with('product')->get();
        if (!empty($data)) {
            return response()->json($data);
        } else {
            return response()->json(["message" => "Something went wrong"]);
        }
    }

    public function testUpload(Request $request)
    {
        $data = $request->all();
        $uploadPath = public_path('/images');
        if ($request->hasFile('testImg')) {
            $file = $request->file('testImg');
            $filename = $file->getClientOriginalName();
            $file->move($uploadPath, $filename);
            return response()->json($data);
        } else {
            return response()->json(["message" => "Something went wrong"]);
        }
    }

    /**
     * Rozapay payment
     */
    public function payment($vendorID, $userID, $productID)
    {
        //get API Configuration
        $api = new Api('rzp_test_fVUykSh2DqZuiy', 'sZWTk5zifNBlMX3Sc16jdrVO');
        $checkIfAlreadyExist = UserSubscription::where([['userId', '=', $userID], ['vendorId', '=', $vendorID], ['productId', $productID]])->get()->toArray();
        if ($checkIfAlreadyExist) return response()->json(['responseType' => 'error', 'message' => 'You already subscribed to this plan!']);
        $orderData = [
            'receipt' => 3456,
            'amount' => 5000,
            'currency' => 'INR',
            'payment_capture' => 1
        ];
        $razorpayOrder = $api->order->create($orderData);
        $razorpayOrderId = $razorpayOrder['id'];
        $displayAmount = $amount = $orderData['amount'];
        return response()->json(['orderID' => $razorpayOrderId]);
    }

    public function addVendorRating(Request $request)
    {
        $postData = $request->all();

        /*
         * rating info gathering
         */
        $vendorID = $postData['vendor_id'];
        $postData['feedback_rating'] = round($postData['feedback_rating'], 2);
        $postData['user_id'] = Auth::id();

        /*
         * check rating already exist
         */
        $checkIf = DB::table('users_feedback')->where(['vendor_id' => $vendorID, 'user_id' => Auth::id()])->count();

        if ($checkIf === 0) {
            $newRatingID = DB::table('users_feedback')->insertGetId($postData);
            if ($newRatingID) DB::table('services')->where('provider_id', $vendorID)->update(['rating' => $newRatingID]);
            $msgType = 'success';
            $message = 'Congrats! Your feedbacks submitted...';
        } else {
            $msgType = 'error';
            $message = 'Sorry! You already given the feedback...';
        }
        return response()->json(['responseType' => $msgType, 'message' => $message]);
    }

    public function orderDetail($orderID)
    {
        return view('pages/orders', ['orderId' => $orderID]);
    }

    public function orderConfirm()
    {
        return view('pages/order-confirmation');
    }

    public function fetchPayment($paymentID)
    {
        //get API Configuration
        $api = new Api('rzp_test_fVUykSh2DqZuiy', 'sZWTk5zifNBlMX3Sc16jdrVO');
        $payment = $api->payment->fetch($paymentID);
        return $payment;
    }

    public function searchVendor($vendorLike)
    {
        $data = Service::where([['business_name', 'like', '%' . $vendorLike . '%']])->get();
        if (!empty($data)) {
            return response()->json($data);
        } else {
            return response()->json(["message" => "Something went wrong"]);
        }
    }


    public function vendors($slug, $unique = '')
    {
        $menu = [
            ['url' => route('vendor', 'profile'),
                'slug' => 'profile',
                'name' => 'Profile'],
            ['url' => route('vendor', 'orders'),
                'slug' => 'orders',
                'name' => 'Orders'],
            ['url' => route('vendor', ['products', 'all']),
                'slug' => 'products',
                'name' => 'Products'],
            ['url' => route('vendor', 'subscriptions'),
                'slug' => 'subscriptions',
                'name' => 'Subscriptions'],
        ];
        return view('vendors/vendor', ['slug' => $slug, 'unique' => $unique, 'menu' => $menu]);
    }

    public function getVendorProfileById($id)
    {
        $data = Service::where([['user_id', '=', $id]])->get();
        return response()->json($data);
    }

    public function getAllSubByVendorId($providerId)
    {
        $userSubscription = UserSubscription::where('vendorId', $providerId)->with('product')->get();
        return response()->json($userSubscription, 200);
    }

    public function singleSubView($subId)
    {
        $userSubscription = UserSubscription::where('id', $subId)->with('product')->get();
        return view('vendors/single-subscription', ['userSubscription' => $userSubscription]);
    }
}

