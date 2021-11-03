<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    private $product;
    /**
     * Class constructor.
     */
    public function __construct()
    {
        $this->product = new Product();
    }
    /**
     * Store 1 record product.
     */
    public function index($id) {
        $category = Category::find($id);
        return $category->products()->get();
    }

    public function show($id) {
        return Product::find($id);
    }

    public function showTags($id) {
        $product = Product::find($id);
        return $product->tags()->get();
    }

    public function showCategory($id) {
        $product = Product::find($id);
        return $product->categories()->get();
    }

    public function showSubImage($id) {
        $product = Product::find($id);
        return $product->product_images()->get();
    }

    public function store(ProductRequest $request) {
        $this->product->saveRecord($this->product, $request);
    }

    public function update(ProductRequest $request, $id) {
        $product = Product::find($id);
        $product->saveRecord($product, $request);
    }
}
