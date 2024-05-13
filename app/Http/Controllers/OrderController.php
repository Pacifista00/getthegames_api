<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function checkout(Request $request){
        $request->validate([
            'name' => 'required|max:54',
            'email' => 'required|email|max:54',
            'amount' => 'required|int',
            'phone' => 'required|numeric',
        ]);

        $order = Order::create([
            'transaction_id' => rand(),
            'name' => $request->name,
            'email' => $request->email,
            'amount' => $request->amount,
            'phone' => $request->phone,
            'status' => "pending"
        ]);

        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $order->transaction_id,
                'gross_amount' => $request->amount,
            ),
            'customer_details' => array(
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return response()->json([
            "snapToken" => $snapToken
        ]);
    }
    public function handleNotification(Request $request){
        $signature = $request->signature_key;
        $status = $request->transaction_status;
        $statusCode = $request->status_code;
        $orderId = $request->order_id;
        $amount = $request->gross_amount;
        $serverKey = config('midtrans.server_key');

        if($signature !== hash('sha512', $orderId.$statusCode.$amount.$serverKey)){
            return response()->json([
                "message" => "invalid Signature Key!",
                "signature key" => $signature,
                "hashed" =>  hash('sha512', $orderId.$status.$amount.$serverKey)
            ]);
        }

        $order= Order::where('transaction_id', $orderId);
        if(!$order){
            return response()->json([
                "message" => "invalid Order!"
            ]);
        }

        if ($status == 'capture') {
            $order->update([
                'status' => 'paid'
            ]);
        }else if($status == 'expire'){
            $order->update([
                'status' => 'expired'
            ]);
        }else if($status == 'cancel'){
            $order->update([
                'status' => 'cancel'
            ]);
        }
    }
}
