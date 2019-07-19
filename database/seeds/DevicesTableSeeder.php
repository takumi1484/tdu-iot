<?php

use Illuminate\Database\Seeder;

class DevicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param=[
            'id'=>1,
            "name"=>"ランプ",
            "user_id"=>1,
            'created_at'=> '2018-11-03 00:00:00',
            'updated_at'=> '2018-11-03 00:00:00',
        ];
        DB::table('devices')->insert($param);
    }
}
