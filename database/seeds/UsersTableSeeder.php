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
        $param=[
            'id'=>1,
            'name'=> 'aaabbbccc',
            'password'=> '$2y$10$6jgFm9PvZ1n24XoOBWGVs.tel4DVX6SFq6TIH5oBFqxYP3Ms591di',
            'remember_token'=> '',
            'current_ir'=> '3\n16711935',
            'created_at'=> '2018-11-03 00:00:00',
            'updated_at'=> '2018-11-03 00:00:00'
        ];
        DB::table('users')->insert($param);
    }
}
