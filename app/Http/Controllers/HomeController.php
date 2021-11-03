<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\ProductImage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $array = [12,13,14];
        $products = [];
        foreach ($array as $id) {
            $category = Category::find($id);
            $products[$id] = $category->products()->get()->toArray();
        }
        return view('homepage')->with('products', $products);
    }

    public function ShowProductDetail($slug) {
        $product = Product::where('slug', $slug)->get()->toArray();
        if($product) {
            $brand = Brand::where('id', $product[0]['brand_id'])->get()->toArray();
            $productImage = ProductImage::where('product_id', $product[0]['id'])->get()->toArray();
            return view('pages.productdetail', ['product' => $product, 'brand' => $brand, 'productImage' => $productImage]);
        }
    }

}
