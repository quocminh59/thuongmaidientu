<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public $products = null;
    public $totalPrice = 0;
    public $totalQuantity = 0;

    public function __construct($cart) {
        if($cart) {
            $this->products = $cart->products;
            $this->totalPrice = $cart->totalPrice;
            $this->totalQuantity = $cart->tatalQuantity;
        }
    }

    public function AddCart($product, $id) {
        $newProduct = ['quantity' => 0,'price' => $product->lastprice ,'productInfo' => $product];
        if($this->products) {
            if(array_key_exists($id, $this->products)) {
                $newProduct = $this->products[$id];
            }
        }
        $newProduct['quantity']++;
        $newProduct['price'] = $newProduct['quantity'] * $product->lastprice;
        $this->products[$id] = $newProduct;
        $this->totalPrice += $product->lastprice;
    }

    public function DeleteItemCart($id) {
        $this->totalPrice -= $this->products[$id]['price'];
        unset($this->products[$id]);
    }
}
