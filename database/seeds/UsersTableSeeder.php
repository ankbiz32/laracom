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
                'email'=>'admin@mail.com',
                'password'=>Hash::make('admin'),
                'role'=>'Admin'
            ],
            [
                'id'=>2,
                'name'=>'Dawn Roe',
                'email'=>'dawnroe@mail.com',
                'password'=>Hash::make('dawnroe'),
                'role'=>'Customer'
            ],
        ]);
    }
}
