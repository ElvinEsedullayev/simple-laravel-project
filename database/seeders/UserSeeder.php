<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;//databesi elave edirik
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
            'name'=>'Elvin',
            'email'=>'elvin@gmail.com',
            'password'=>bcrypt(123456),//tehlukesizlik kodu
        ]);
    }
}
