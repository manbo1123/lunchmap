<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('categories') -> insert([
            ['name' => 'カフェ・スイーツ'],
            ['name' => 'ジャンクフード'],
            ['name' => '中華'],
            ['name' => 'イタリアン'],
            ['name' => 'フレンチ'],
            ['name' => 'アジア・エスニック'],
            ['name' => '肉'],
            ['name' => '和食'],
            ['name' => '郷土料理'],
            ['name' => '居酒屋・バー'],
            ['name' => 'その他'],
        ]);
    }
}
