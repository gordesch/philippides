<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Section::class, 10)->create();
        factory(App\BroadcastList::class, 100)->create();
        factory(App\Sending::class, 400)->create();
        factory(App\Person::class, 4000)->create();
    }
}
