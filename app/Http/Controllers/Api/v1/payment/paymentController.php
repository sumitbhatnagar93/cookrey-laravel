<?php

namespace App\Http\Controllers\Api\v1\payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class paymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('cors');
    }

    public function paymentProcess(Request $request)
    {
        $data = $request->all();
        \Stripe\Stripe::setApiKey('sk_test_lzoI9yb6JzKdp8jjTTxW50bA00T2mfODlx');

        $token = $data['token'];
        $amount = $data['amount'] * 100;
        $charge = \Stripe\Charge::create([
            'currency' => 'inr',
            'amount' => $amount,
            'description' => 'Payment Via Card',
            'source' => $token,
        ]);
        if ($charge) {
            return response()->json($charge);
        } else {
            return response()->json(["message" => "Unable to pay"]);
        }
    }
}
