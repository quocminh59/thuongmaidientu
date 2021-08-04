<?php

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Services\CategoryService;

class CategoriesTableSeeder extends Seeder
{
    use CategoryService;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 3; $i++) {
            $category = new Category();
            $category->category_name = 'Danh mục cha '.$i;
            $category->category_code = '0';
            $category->slug = $this->changeTitle($category->category_name);
            $category->status = '1';
            $category->save();
            for($m = 0; $m < 3; $m++) {
                $category1 = new Category();
                $category1->category_name = 'Danh mục phụ cấp 1 số '.$m;
                $category1->category_code = $category->category_id;
                $category1->slug = $this->changeTitle($category1->category_name);
                $category1->status = '1';
                $category1->save();
                for($n = 0; $n < 3; $n++) {
                    $category2 = new Category();
                    $category2->category_name = 'Danh mục phụ cấp 2 số '.$n;
                    $category2->category_code = $category1->category_id;
                    $category2->slug = $this->changeTitle($category2->category_name);
                    $category2->status = '1';
                    $category2->save();
                }
            }
        }
    }
}
