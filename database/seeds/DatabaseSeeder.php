<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       factory(\App\Model\Register::class,20)->create();
       factory(\App\Model\Message::class,200)->create();
    }
}
