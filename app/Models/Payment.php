<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\InfoCustomerRequest;
use Session;

class Payment extends Model
{
    
    public function ValidateRequest(InfoCustomerRequest $request)
    {
        return true;
    }

    public function createPayment(Request $request) {
        return view('vnpay.index');
    }
}
