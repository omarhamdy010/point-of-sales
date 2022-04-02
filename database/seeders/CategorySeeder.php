<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['cat_one','cat_two','cat_three'];
        foreach ($categories as $category){
            Category::create([
                'ar'=>['name'=>$category],
                'en'=>['name'=>$category],
            ]);
        }
    }
}
