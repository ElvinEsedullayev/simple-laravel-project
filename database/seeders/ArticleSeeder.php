<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;//databesi elave edirik

use Faker\Factory as Faker;//fgaker elave edirik
use Illuminate\Support\Str;//slug ucun bu kitabxanani elave edirik

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Faker::create();
        for ($i=0; $i < 5 ; $i++) { 
            $title=$faker->sentence(6);
            $slug = Str::slug($title, '-');
            DB::table('articles')->insert([
                'cat_id'=>rand(1,7),
                'title'=>$title,
                'image'=>$faker->imageUrl(800, 400, 'cats'),
                'article'=>$faker->paragraph(6),
                'slug'=>$slug,
                'created_at'=>$faker->dateTime('now'),
                'updated_at'=>now()
            ]);
        }
    }
}
