<?php

use Illuminate\Database\Seeder;
use App\Restdata;

class RestdataTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $param = [
        'message' => 'Google Japan',
        'url' => 'https://www.google.com.jp',
      ];
      $restdata = new Restdata;
      $restdata->fill($param)->save();
      $param = [
        'message' => 'Yahoo Japan',
        'url' => 'https://www.yahoo.co.jp',
      ];
      $restdata = new Restdata;
      $restdata->fill($param)->save();
    }
}
