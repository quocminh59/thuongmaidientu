<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\CategoryRequest;
use App\Services\CategoryService;
use App\Models\Product;

class Category extends Model
{
    use CategoryService;

    protected $guarded = ['slug'];
    protected $primaryKey = 'category_id';
    public $list = [];
    public $listDel = [];
    public $listSub = [];

    public function categoryRecursive($categories,$parent_id = 0, $char = '') {
        foreach($categories as $key => $item) {
            if($item['category_code'] == $parent_id ) {
                $item['category_name'] = $char. ' '.$item['category_name'];
                $this->list[] = $item;
                unset($categories[$key]);
                $this->categoryRecursive($categories,$item['category_id'],$char.'|---');
            }
        }
    }

    public function recursiveDelete($categories, $id) {
        foreach ($categories as $key => $item) {
            if($item['category_id'] == $id) {
                $this->listDel[] = $item['category_id'];
                unset($categories[$key]);
            }
            else {
                if($item['category_code'] == $id) {
                    $this->listDel[] = $item['category_id'];
                    $this->listSub[] = $item;
                    unset($categories[$key]);
                    $this->recursiveDelete($categories, $item['category_id']);
                }
            }
        }
    }

    public function saveRecord(Category $category, CategoryRequest $request) {
        $category->category_name = $request->category_name;
        $category->category_code = $request->category_code;
        $category->slug = $this->changeTitle($request->category_name);
        $category->status = $request->status;
        $category->save();
    }
    
    // Relationship Database
    public function products() {
        return $this->belongsToMany(Product::class,'category_product','category_id','product_id');
    }
}
