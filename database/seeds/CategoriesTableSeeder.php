<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'id'=>1,
                'name'=>'Agro Health',
                'parent_id'=>0,
                'img_src'=>'categories/1.jpeg',
                'meta_title'=>'agro-health',
                'meta_description'=>'',
            ],
            [
                'id'=>2,
                'name'=>'Organic Fertilizers',
                'parent_id'=>1,
                'img_src'=>'categories/2.jpeg',
                'meta_title'=>'organic-fertilizers',
                'meta_description'=>'',
            ]
        ]);
    }
}
