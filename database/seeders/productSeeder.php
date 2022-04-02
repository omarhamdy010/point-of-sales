<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class productSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = ['pro_one','pro_two','pro_three'];
        foreach ($products as $product){
            Product::create([
                'ar'=>['name'=>$product , 'description'=>'this is desc arabic' . $product],
                'en'=>['name'=>$product, 'description'=>'this is desc english' . $product],
                'selling_price'=>50,
                'stock'=>100,
                'Purchasing_price'=>30,
                'category_id'=>1,
            ]);

            Product::create([
                'ar'=>['name'=>$product , 'description'=>'this is desc arabic' . $product],
                'en'=>['name'=>$product, 'description'=>'this is desc english' . $product],
                'selling_price'=>50,
                'stock'=>100,
                'Purchasing_price'=>30,
                'category_id'=>2,
            ]);

            Product::create([
                'ar'=>['name'=>$product , 'description'=>'this is desc arabic' . $product],
                'en'=>['name'=>$product, 'description'=>'this is desc english' . $product],
                'selling_price'=>50,
                'stock'=>100,
                'Purchasing_price'=>30,
                'category_id'=>3,
            ]);
        }

    }
}
