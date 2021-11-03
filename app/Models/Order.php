<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Order extends Model
{
    public $orderCode;
    public $currentOrderId;
    protected $fillable = [
        'order_code',
        'user_id',
        'name',
        'phone',
        'address',
        'total_price',
        'payment_type',
        'purchase_date',
        'status',
    ];
    public $timestamps = false;
    public $stt= [
        'processing' => 'Đơn hàng đang xử lý',
        'preparing' => 'Đang chuẩn bị đơn hàng',
        'shipping' => 'Đơn hàng đang vận chuyển',
        'cancel' => 'Đơn hàng bị hủy',
        'done' => 'Đơn hàng hoàn thành'
    ]; 

    public function __construct() {
        $this->orderCode = 'QMPC-'.date('Y').'-';
        if(Order::count() == 0) {
            $this->orderCode = $this->orderCode.'1';
        }
        else {
            $maxID = Order::max('id');
            $nextID = $maxID + 1;
            $this->orderCode = $this->orderCode.$nextID;
        }
    }

    public function createOrder(Request $request)
    {
        $newOrder = new Order();
        $newOrder->order_code = $this->orderCode;
        $newOrder->user_id = 'kl';
        $newOrder->name = $request->name;
        $newOrder->phone = $request->phone;
        $newOrder->address = $request->address.' '.$request->ward.' '.$request->district.' '.$request->province;
        $newOrder->total_price = $request->total_price;
        $newOrder->payment_type = $request->payment_type;
        $newOrder->purchase_date = date("Y-m-d H:i:s");
        $newOrder->status = $this->getStatus($request->payment_type);
        $newOrder->save();
        $this->currentOrderId = $newOrder->id;
    }

    public function getStatus($value) {
        // Đối với hình thức thanh toán khi nhận hàng
        if($value == 1) return $this->stt['preparing'];
        // Đối với hình thức thanh toán trước
        else return $this->stt['processing'];
    }

    public function getParam($orderId) {
        $order = Order::where('id', $orderId)->first();
        return $order->toArray();
    }
}
