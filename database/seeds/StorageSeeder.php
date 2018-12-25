<?php

use Illuminate\Database\Seeder;

class StorageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(\App\Models\Storage::class, 1)->create([
            'storage' => 16,
        ]);
        factory(\App\Models\Storage::class, 1)->create([
            'storage' => 32,
        ]);
        factory(\App\Models\Storage::class, 1)->create([
            'storage' => 64,
        ]);
    }
}
