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
                'name'=>'ấm chén',
                'description'=>'ấm chén',
            ]);
            factory(\App\Models\Category::class, 1)->create([
                'name'=>'bình',
                'description'=>'bình để đựng nước',
            ]);
            factory(\App\Models\Category::class, 1)->create([
                'name'=>'ấm chén',
                'description'=>'ấm chén',
            ]);
            factory(\App\Models\Category::class, 1)->create([
                'name'=>'bát đũa',
                'description'=>'bát đũa',
            ]);

    }
}
