<?php

use Illuminate\Database\Seeder;

class RamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(\App\Models\Ram::class, 1)->create([
            'ram' => 2,
        ]);
        factory(\App\Models\Ram::class, 1)->create([
            'ram' => 4,
        ]);
        factory(\App\Models\Ram::class, 1)->create([
            'ram' => 6,
        ]);
    }
}
