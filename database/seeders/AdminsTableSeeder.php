<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins') -> insert([
            [
                'name' => '管理者',
                'email' => 'admintest@gmail.com',
                'password' => Hash::make('admintest'),
                'department' => 'test.inc',
            ],
            [
                'name' => '管理者2',
                'email' => 'admintest2@gmail.com',
                'password' => Hash::make('admintest2'),
                'department' => 'test2.inc',
            ],

        ]);
    }
}
