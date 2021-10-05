<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\InfoCustomerRequest;

class Cart extends Model
{
    public $products = null;
    public $totalPrice = 0;
    public $totalQuantity = 0;
    public $status = true;

    public function __construct($cart) {
        if($cart) {
            $this->products = $cart->products;
            $this->totalPrice = $cart->totalPrice;
            $this->totalQuantity = $cart->totalQuantity;
            $this->status = $cart->status;
        }
    }

    public function AddCart($product, $id) {
        $newProduct = ['quantity' => 0,'price' => $product->lastprice ,'productInfo' => $product, 'status' => true];
        if($this->products) {
            if(array_key_exists($id, $this->products)) {
                $newProduct = $this->products[$id];
            }
        }
        $newProduct['quantity']++;
        $newProduct['price'] = $newProduct['quantity'] * $product->lastprice;
        $this->products[$id] = $newProduct;
        if($this->products[$id]['status'] == true ) {
            $this->totalPrice += $product->lastprice;
            $this->totalQuantity++;
        }
    }

    public function UpdateCart($product, $id, $quantity) {
        if($this->products[$id]['status'] == true ) {
            $this->products[$id]['quantity'] = $quantity;
            $this->products[$id]['price'] = $product->lastprice * $quantity;
            $this->totalQuantity = 0;
            $this->totalPrice = 0;
            foreach ($this->products as $item) {
                $this->totalQuantity += $item['quantity'];
                $this->totalPrice += $item['price'];
            }
        }
        else {
            $this->products[$id]['quantity'] = $quantity;
            $this->products[$id]['price'] = $product->lastprice * $quantity;
        }
    }

    public function DeleteItemCart($id) {
        $this->totalPrice -= $this->products[$id]['price'];
        unset($this->products[$id]);
    }

    public function VirtualDelAll() {
        if($this->status == true) {
            $this->status = false;
            $this->totalQuantity = 0;
            $this->totalPrice = 0;
            foreach ($this->products as $key => $item) {
                $this->products[$key]['status'] = false;
            }
        }
        else {
            $this->totalQuantity = 0;
            $this->totalPrice = 0;
            foreach($this->products as $key => $item) {
                $this->totalQuantity += $item['quantity'];
                $this->totalPrice += $item['price'];
                $this->products[$key]['status'] = true;
            }
            $this->status = true;
        }
    }

    public function VirtualDelItem($id) {
        if($this->totalPrice > 0) {
            $this->totalPrice = $this->totalPrice - $this->products[$id]['price'];
            $this->totalQuantity = $this->totalQuantity - $this->products[$id]['quantity'];
        }
        $this->products[$id]['status'] = false;
        $this->status = false;
    }

   public function RestoreDelItem($id) {
        $this->totalPrice = $this->totalPrice + $this->products[$id]['price'];
        $this->totalQuantity = $this->totalQuantity + $this->products[$id]['quantity'];
        $this->products[$id]['status'] = true;
        $this->status = true;
        foreach ($this->products as $item) {
            if($item['status'] == false) $this->status = false;
        }
   }

   public function GetInfoCustomer(InfoCustomerRequest $request) {
       return $request;
   }
}
