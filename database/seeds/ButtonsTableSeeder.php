<?php

use Illuminate\Database\Seeder;

class ButtonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param=[
            'name'=>'電源ON',
            'device_id'=>'1',
            'ir_code'=>'3?16711935',
            'created_at'=> '2018-11-03 00:00:00',
            'updated_at'=> '2018-11-03 00:00:00'
        ];
        DB::table('buttons')->insert($param);
        $param=[
            'name'=>'電源OFF',
            'device_id'=>'1',
            'ir_code'=>'3?16744575',
            'created_at'=> '2018-11-03 00:00:00',
            'updated_at'=> '2018-11-03 00:00:00'
        ];
        DB::table('buttons')->insert($param);
    }
}
