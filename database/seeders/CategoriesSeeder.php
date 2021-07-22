<?php

namespace Database\Seeders;
use Illuminate\Support\Str;//slug ucun bu kitabxanani elave edirik
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;//db elave edilir

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories=['Genel','Spor','Eylence','Gunluk Ritm','Teknoloji','Eyitim','Bilisim','Sagliq'];
        foreach($categories as $category){
            $slug = Str::slug($category, '-');
            DB::table('categories')->insert([
                'name'=>$category,
                'slug'=>$slug,
                'created_at'=>now(),
                'updated_at'=>now()//indiki vaxti gosterir
            ]);
        }
    }
}
