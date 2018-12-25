<?php

use Illuminate\Database\Seeder;

class CpuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(\App\Models\Cpu::class, 1)->create([
            'cpu' => 'Apple A10 Fusion',
        ]);
        factory(\App\Models\Cpu::class, 1)->create([
            'cpu' => 'Snapdragon 845',
        ]);
        factory(\App\Models\Cpu::class, 1)->create([
            'cpu' => 'Helio X10',
        ]);
    }
}
