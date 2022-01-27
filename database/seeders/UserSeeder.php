<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Nguyễn Trần Phú PHP Dev',
            'email' => 'phunguyen4869@gmail.com',
            'password' => bcrypt('123123'),
            'phone' => '0848818727',
            'address' => 'Vung Tau',
            'payment_method' => 'credit_card',
        ]);
    }
}
