<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<100;$i++){
            factory(App\User::class, 1)->create(['admin'=>0,'name'=>'user_'.$i,'email'=>'user_'.$i.'@test.com']);
        }

        factory(App\User::class, 1)->create(['admin'=>1,'name'=>'admin','email'=>'admin'.'@test.com']);
    }
}
