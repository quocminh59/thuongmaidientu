<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Home extends Model
{
    private $categories;
    private $parentCategory;
    private $subCategories;

    public function __construct() {
        $this->categories = Category::all()->toArray();
        $this->parentCategory = Category::where("category_code", '0')->get()->toArray();
        $this->subCategories = [];
    }
    public function getCategories() {
        return $this->parentCategory;
    }

    public function getSubCategories() {
        foreach ($this->parentCategory as $item) {
            $category = new Category();
            $category_id = $item["category_id"];
            $category->recursiveDelete($this->categories,$category_id);    
            array_push($this->subCategories,$category->listSub );
        }
        return $this->subCategories;
    }

}
