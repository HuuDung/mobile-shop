<?php

use Illuminate\Database\Seeder;

class SystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(\App\Models\System::class, 1)->create([
            'system' => 'IOS',
        ]);
        factory(\App\Models\System::class, 1)->create([
            'system' => 'Androi',
        ]);
    }
}
