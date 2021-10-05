<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Http\Requests\InfoCustomerRequest;

class PayController extends Controller
{
    public function ValidateRequest(InfoCustomerRequest $request) {}

    public function index() {
        $payment = new Payment();
        $payment->createPayment();
    }
}
