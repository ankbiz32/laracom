<?php

use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('brands')->insert([
            [
                'id'=>1,
                'name'=>'Parle',
                'img_src'=>'brands/1.png'
            ]
        ]);
    }
}
