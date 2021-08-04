<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\BrandRequest;
use App\Models\Brand;

class BrandController extends Controller
{
    private $brand;

    public function __construct() {
        $this->brand = new Brand();
    }

    public function index() {
        return Brand::all();
    }

    public function store(BrandRequest $request) {
        $this->brand->saveRecord($this->brand,$request);
    }

    public function show($id) {
        return Brand::find($id);
    }

    public function update(BrandRequest $request, $id){
        $brand = Brand::find($id);
        $brand->saveRecord($brand, $request);
    }

    public function destroy($id) {
        $brand = Brand::find($id);
        $brand->delete();
    }
}
