<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Requests\InfoCustomerRequest;
use App\Models\Order;
use Session;

class Payment extends Model
{
    public function ValidateRequest(InfoCustomerRequest $request)
    {
        return true;
    }

    public function viewPayment($token, $paymentType, $orderId) {
        if(Session('Cart')) {
            if($token == Session('Cart')->token) {
                if($paymentType == 1) return "Trang thanh toan khi dat hang";
                else if($paymentType == 2) {
                    // get orderCode and price
                    $order = new Order();
                    $data = $order->getParam($orderId);
                    return view('vnpay.index', [
                        'orderCode' => $data['order_code'],
                        'price' => $data['total_price']
                    ]);
                }
            }
        }
        return 'Trang web khong ton tai';
    }

    public function payment(Request $request) {
        $newOrder = new Order();
        $newOrder->createOrder($request);
        return $newOrder->currentOrderId;
    }
}
