<?php

namespace App\Providers;
use Illuminate\Pagination\Paginator;//pagination normal gorunmesi ucun elave etdik birde boot icinde bir kod elave etdik
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Route;
use App\Models\Ayarlar;//yazdigimiz modeli elave edirik
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->share('ayarlar',Ayarlar::find(1));//butun view sehifelerinde ayarlar modelini gonderdik..ayarlar deyiskeni ile..meselen titleni cekmek ucun
        Schema::defaultStringLength(191);
        Paginator::useBootstrap();//pagination normal gorunmesi ucun elave etdik birde namespace altinda bir kod elave etdik
        
        Route::resourceVerbs([
            
            'create'=>'olustur',
            'edit'=>'guncelle'
        ]); 
        //bu crud isleminde create,update url adlarinin deyisilmesi ucun yazilan koddu
        
        //
    }
}
