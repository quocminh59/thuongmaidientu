<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Order;
use App\Http\Requests\InfoCustomerRequest;
use Str;

class PayController extends Controller
{
    protected $payment;

    public function __construct() {
        $this->payment = new Payment();
    }

    public function index($token, $paymentType, $orderId) {
        return $this->payment->viewPayment($token, $paymentType, $orderId);
    }

    public function ValidateRequest(InfoCustomerRequest $request) {}

    public function postPayment(Request $request) {
        return $this->payment->payment($request);
    }

    public function createPayment(Request $request) {
        $vnp_TxnRef = $request->order_code; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = $request->order_desc;
        $vnp_OrderType = $request->order_type;
        $vnp_Amount = $request->amount * 100;
        $vnp_Locale = $request->language;
        $vnp_BankCode = $request->bank_code;
        $vnp_IpAddr = request()->ip();

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => config('vnpay.vnp_TmnCode'),
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => config('vnpay.vnp_Returnurl'),
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = config('vnpay.vnp_Url') . "?" . $query;
        if (config('vnpay.vnp_HashSecret')) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, config('vnpay.vnp_HashSecret')); 
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        return redirect($vnp_Url);
    }

    public function return(Request $request) {
        $vnp_SecureHash = $request->vnp_SecureHash;
        $inputData = array();
        foreach ($request->toArray() as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }
        
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, config('vnpay.vnp_HashSecret'));

        $message = '';
        if ($secureHash == $vnp_SecureHash) {
            if ($request->vnp_ResponseCode == '00') {
                $message = "<span style='color:blue'>GD Thanh cong</span>";
            } else {
                $message = "<span style='color:red'>GD Khong thanh cong</span>";
            }
        } else {
            $message = "<span style='color:red'>Chu ky khong hop le</span>";
        }

        // data passed to view
        $data = [
            'vnp_TxnRef' => $request->vnp_TxnRef,
            'vnp_Amount' => $request->vnp_Amount,
            'vnp_OrderInfo' => $request->vnp_OrderInfo,
            'vnp_ResponseCode' => $request->vnp_ResponseCode,
            'vnp_TransactionNo' => $request->vnp_TransactionNo,
            'vnp_BankCode' => $request->vnp_BankCode,
            'vnp_PayDate' => $request->vnp_PayDate,
            'message' => $message,
        ];
        return view('vnpay.vnpay_return', ['data' => $data]);
    }

}
