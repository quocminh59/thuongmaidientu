<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\ProductRequest;
use App\Services\ProductService;
use App\Models\ProductImage;
use App\Models\Tag;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;

class Product extends Model
{
    use ProductService;

    protected $fillable = [
        "id",
        "name",
        "slug",
        "price",
        "sales_percent",
        "lastprice",
        "feature_image",
        "content",
        "brand_id",
        "gift",
        "quantity",
        "accesstimes",
        "specifications",
    ];

    // relationship database
    public function product_images() {
        return $this->hasMany(ProductImage::class);
    }

    public function categories() {
        return $this->belongsToMany(Category::class,'category_product','product_id', 'category_id');
    }

    public function tags() {
        return $this->belongsToMany(Tag::class, 'product_tag', 'product_id', 'tag_id');
    }

    public function brands() {
        return $this->belongsTo( Brand::class, 'brand_id');
    }

    public function removeItemRepeating($arrayCheck = [], $arrayIsChecked) {
        foreach($arrayIsChecked as $item) {
            foreach($arrayCheck as $key => $value) {
                if($value == $item) {
                    unset($arrayCheck[$key]);
                }
            }
        }
        return $arrayCheck;
    }

    // processing function
    public function showAllProducts() {
        return Product::all();
    }

    public function pivotCategoryProduct(ProductRequest $request, $product_id) {
        $product = Product::find($product_id);
        $product_categories = $product->categories->toArray();

        if($product_categories == null) {
            $product->categories()->attach($request->category);
        }
        else {
            $arrayIsChecked = [];
            $arrayCheck = $request->category;
            foreach ($product->categories as $product_category) {
                array_push($arrayIsChecked, $product_category['category_id']);
            }
            $arrayResult = $this->removeItemRepeating($arrayCheck, $arrayIsChecked);
            $product->categories()->attach($arrayResult);
        }
    }

    public function saveProductImage(ProductRequest $request, $product_id) {
        $product = Product::find($product_id);
        $list_images = $product->product_images()->get()->toArray();
        if($list_images == null) {
            foreach($request->subimage as $item) {
                $product_image = new ProductImage(['image_path' => $item]);
                $product->product_images()->save($product_image);
            }
        }
        else {
            foreach($request->subimage as $item) {
                $flag = 1;
                foreach($list_images as $list) {
                    if($list['image_path'] == $item) {
                        $flag = 0;
                        break;
                    }
                }
                if($flag == 1) {
                    $product_image = new ProductImage(['image_path' => $item]);
                        $product->product_images()->save($product_image);
                }
            }
        }
    }

    public function saveTags(ProductRequest $request, $product_id) {
        $tagList = Tag::all()->toArray();
        $flag = 0;
        $tag_id = null;
        if($request->tag) {
            foreach($request->tag as $item) {
                foreach($tagList as $tag) {
                   if($item == $tag['tag_name']){
                        $flag = 1;
                        $tag_id = $tag['id'];
                        break;
                   }
                }
                if($flag == 0) {
                    $t = new Tag();
                    $t->tag_name = $item;
                    $t->save();
                    $t->products()->attach($product_id);
                }
                else{
                    $t = Tag::find($tag_id);
                    $t->products()->attach($product_id);
                }
                $flag = 0;
                $tag_id = null;
            }
        }
    }

    public function saveRecord(Product $product, ProductRequest $request) {
        $product->name = $request->name;
        $product->slug = $this->changeTitle($request->name);
        $product->price = $request->price;
        $product->sales_percent = $request->sales_percent/100;
        $product->lastprice = $product->price - $this->RoundPrice($product->price * $product->sales_percent);
        $product->quantity = $request->quantity;
        $product->brand_id = $request->brand_id;
        $product->feature_image = $request->feature_image[0];
        $product->specifications = json_encode($request->para);
        $product->content = $request->content;
        $product->gift = $request->gift;
        $product->save();
        $product_id = $product->id;
        $this->pivotCategoryProduct($request,$product_id);
        $this->saveProductImage($request,$product_id);
        $this->saveTags($request,$product_id);
    }

}
