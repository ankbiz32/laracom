<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'id'=>1,
                'name'=>'PRODUCT 1',
                'price'=>1375,
                'category_id'=>'["1"]',
                'brand_id'=>1,
                'image'=>'products/1.jpg',
                'max_order_qty'=>5,
                'tags'=>'["seeds","fertilizer"]',
            ],
            [
                'id'=>2,
                'name'=>'PRODUCT 2',
                'price'=>375,
                'category_id'=>'["1"]',
                'brand_id'=>1,
                'image'=>'products/2.jpg',
                'max_order_qty'=>5,
                'tags'=>'["seeds","fertilizer"]',
            ],
            [
                'id'=>3,
                'name'=>'PRODUCT 3',
                'price'=>155,
                'category_id'=>'["1"]',
                'brand_id'=>1,
                'image'=>'products/3.jpg',
                'max_order_qty'=>5,
                'tags'=>'["seeds","fertilizer"]',
            ],
            [
                'id'=>4,
                'name'=>'PRODUCT 4',
                'price'=>225,
                'category_id'=>'["1"]',
                'brand_id'=>1,
                'image'=>'products/4.jpg',
                'max_order_qty'=>5,
                'tags'=>'["seeds","fertilizer"]',
            ],
            [
                'id'=>5,
                'name'=>'PRODUCT 5',
                'price'=>755,
                'category_id'=>'["1"]',
                'brand_id'=>1,
                'image'=>'products/5.jpg',
                'max_order_qty'=>5,
                'tags'=>'["seeds","fertilizer"]',
            ],
            [
                'id'=>6,
                'name'=>'PRODUCT 6',
                'price'=>779,
                'category_id'=>'["1"]',
                'brand_id'=>1,
                'image'=>'products/6.jpg',
                'max_order_qty'=>5,
                'tags'=>'["seeds","fertilizer"]',
            ]
        ]);
    }
}
