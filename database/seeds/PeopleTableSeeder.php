<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;



class PeopleTableSeeder extends Seeder
{

    public function run()
    {
        $param = [
          'name' => 'taro',
          'mail' => 'aaa@aaa.jp'
          'age' => 12,
        ];
        DB::table('people')->insert($param);
        $param = [
          'name' => 'ziro',
          'mail' => 'iii@iii.jp'
          'age' => 14,
        ];
        DB::table('people')->insert($param);
        $param = [
          'name' => 'saburo',
          'mail' => 'uuu@uuu.jp'
          'age' => 15,
        ];
        DB::table('people')->insert($param);
        // DatabaseSeeder.phpにseederの登録をしなくてはならない。
    }
}
