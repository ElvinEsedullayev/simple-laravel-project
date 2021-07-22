<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;//databesi elave edirik
class AyarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ayarlars')->insert([
            'title'=>'Blog Sitesi Kodlamasi',
            'created_at'=>now(),
            'updated_at'=>now()
        ]);
    }
}
