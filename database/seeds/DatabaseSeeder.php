<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{

    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(PeopleTableSeeder::class);
        $this->call(RestdataTableSeeder::class);
    }
}
