<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Services\BrandService;
use App\Http\Requests\BrandRequest;

class Brand extends Model
{
    use BrandService;
    protected $fillable = ['brand_name', 'slug'];
 
    public function products() {
        return $this->hasMany(Product::class);
    }

    public function saveRecord(Brand $brand, BrandRequest $request) {
        $brand->brand_name = $request->brand_name;
        $brand->slug = $this->changeTitle($brand->brand_name);
        $brand->save();
    }
}
