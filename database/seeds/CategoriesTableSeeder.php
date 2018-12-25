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
        //

            factory(\App\Models\Category::class, 1)->create([
                'name'=>'Oppo',
                'description'=>'Điện thoại Đài Loan',
            ]);
            factory(\App\Models\Category::class, 1)->create([
                'name'=>'Samsung',
                'description'=>'Điện thoại Hàn Quốc',
            ]);
            factory(\App\Models\Category::class, 1)->create([
                'name'=>'Iphone',
                'description'=>'Táo cắn dở',
            ]);
            factory(\App\Models\Category::class, 1)->create([
                'name'=>'Huawei',
                'description'=>'Điện thoại Trung Quốc',
            ]);
    }
}
