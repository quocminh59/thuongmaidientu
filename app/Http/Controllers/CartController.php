<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Session;

class CartController extends Controller
{
    public function index() {
        return view('pages.cart'); 
    }

    public function AddCart(Request $request,$id) {
        $product = Product::where('id', $id)->first();
        if($product != null) {
            $oldCart = Session('Cart') ? Session('Cart') : null;
            $newCart = new Cart($oldCart);
            $newCart->AddCart($product, $id);
            $request->session()->put('Cart', $newCart);
            return $product;           
        }

    }

    public function UpdateCart(Request $request, $id, $quantity) {
        $product = Product::where('id', $id)->first();
        if($product != null) {
            $oldCart = Session('Cart') ? Session('Cart') : null;
            $newCart = new Cart($oldCart);
            $newCart->UpdateCart($product, $id, $quantity);
            $request->session()->put('Cart', $newCart);      
        }
    }

    public function DeleteItemCart(Request $request,$id) {
        $oldCart = Session('Cart') ? Session('Cart') : null;
        $newCart = new Cart($oldCart);
        $newCart->DeleteItemCart($id);
        if(Count($newCart->products) > 0) {
            $request->Session()->put('Cart', $newCart);
        }
        else {
            $request->Session()->forget('Cart');
        }
    }

    public function VirtualDeleteAll(Request $request) {
        $oldCart = Session('Cart') ? Session('Cart') : null;
        $newCart = new Cart($oldCart);
        $newCart->VirtualDelAll();
        $request->session()->put('Cart', $newCart);
    }

    public function VirtualDeleteItem(Request $request, $id) {
        $oldCart = Session('Cart') ? Session('Cart') : null;
        $newCart = new Cart($oldCart);
        $newCart->VirtualDelItem($id);
        $request->session()->put('Cart', $newCart);
    }

    public function RestoreDeleteItem(Request $request, $id) {
        $oldCart = Session('Cart') ? Session('Cart') : null;
        $newCart = new Cart($oldCart);
        $newCart->RestoreDelItem($id);
        $request->session()->put('Cart', $newCart);
    }

    public function DeleteAll(Request $request) {
        $request->Session()->forget('Cart');
    }

    public function CreatePayment(Request $request) {
        return view('vnpay.index');
    }
}
