<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Services\CategoryService;
use App\Http\Requests\CategoryRequest;


class CategoryController extends Controller
{
    use CategoryService;
    // Display list of categories
    private $categories;

    public function __construct() {
        $this->categories = Category::all()->toArray();
    }

    public function index() {
        return Category::where('category_code', 0)->get();
    }

    // Display list of categories after recursive
    public function showCategoriesRecursive() {
        $modelCategory = new Category();
        $modelCategory->categoryRecursive($this->categories,0,'');
        return $modelCategory->list;
        
    }

    public function showSubCategories($id) {
        $Category = new Category();
        $Category->recursiveDelete($this->categories,$id);
        return $Category->listSub;
    }

    public function showSubCategoriesRecursive($id) {
        $Category = new Category();
        $Category->recursiveDelete($this->categories,$id);
        $Category->categoryRecursive($Category->listSub,$id,'');
        return $Category->list;
    }

    public function store(CategoryRequest $request) {
        $category = new Category();
        $category->saveRecord($category, $request); 
    }

    // Display the specified category
    public function show($id) {
        return Category::findOrFail($id);
    }

    public function update(CategoryRequest $request, $id) {
        $category = Category::find($id);
        $category->saveRecord($category,$request);
    }
   
    public function destroy($id) {
        $category = new Category();
        $category->recursiveDelete($this->categories,$id);
        Category::destroy($category->listDel);
    }

}
