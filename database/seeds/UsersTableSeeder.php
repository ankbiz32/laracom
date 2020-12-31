<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id'=>1,
                'name'=>'Admin',
                'email'=>'admin@admin.com',
                'password'=>Hash::make('admin'),
                'role'=>'Admin',
                'country_iso_code'=>'0'
            ],
            [
                'id'=>2,
                'name'=>'Dawn Roe',
                'email'=>'user@gmail.com',
                'password'=>Hash::make('user'),
                'role'=>'Customer',
                'country_iso_code'=>'IN'
            ],
        ]);
    }
}
