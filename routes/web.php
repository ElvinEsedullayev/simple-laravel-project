<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Giris;

Route::get('sayt-temirde',function(){
   return view('front.bos');
});

// -------------BACK END --------------
Route::prefix('admin')->name('admin.')->middleware('isLogin')->group(function(){
   Route::get('login','App\Http\Controllers\Back\Giris@giris')->name('login');
   Route::post('login','App\Http\Controllers\Back\Giris@girisPost')->name('login.post');
});
Route::prefix('admin')->name('admin.')->middleware('isAdmin')->group(function(){
   Route::get('panel','App\Http\Controllers\Back\Dasboard@index')->name('panel');
               // ARTICLE ,XEBER ISLEMLERI
   Route::get('meqaleler/silinenler','App\Http\Controllers\Back\ArticleController@trashed')->name('silinen.article');//softdelete ucun yeni silinen melumatlarin geri donusu ucun
   
   Route::resource('meqaleler','App\Http\Controllers\Back\ArticleController');//bu grud ile yaradilan articlecontrollor ucundu..edile bilen butun routeleri ozu icinde yaradir..only ve except methodu var,sonda yazilir..only deyib controller icinde hansi metodun calismasini istediyimizi qeyd ede bilerik..meselen index ve create..ve except de ise o metoddan basqa hamsi calissin deye bilerik


   Route::get('/switch','App\Http\Controllers\Back\ArticleController@switch')->name('switch');//switch funksiyasi ucundu..on of duymesini duzeltmek ucun yazdiq
   Route::get('/deletearticle/{id}','App\Http\Controllers\Back\ArticleController@delete')->name('delete.article');//silme routumuz
   Route::get('/harddeletearticle/{id}','App\Http\Controllers\Back\ArticleController@hardDelete')->name('hard.delete.article');//temiz silmek ucun 
   Route::get('/recorvedarticle/{id}','App\Http\Controllers\Back\ArticleController@recorved')->name('recorved.article');//silinen melumati geri dondururk

               // CATEGORI ISLEMLERI
   Route::get('/categoriler','App\Http\Controllers\Back\CategoryController@index')->name('category.index');//categori sehifesini gostermek ucun yazilib    
   Route::post('/categoriler/ekle','App\Http\Controllers\Back\CategoryController@create')->name('category.create.index');//categori sehifesini gostermek ucun yazilib  
   Route::post('/categoriler/delete','App\Http\Controllers\Back\CategoryController@delete')->name('category.delete');//categori silmek ucun,modul ucun verilendi..
   Route::post('/categoriler/duzenle','App\Http\Controllers\Back\CategoryController@duzenle')->name('category.duzenle');//categorini duzenlemek
   Route::get('/categoriler/durum','App\Http\Controllers\Back\CategoryController@switch')->name('durum.switch');//switch funksiyasi ucundu..on of edir..yeni durumu db e yukluyur..jquery ile  
   Route::get('/categoriler/update','App\Http\Controllers\Back\CategoryController@update')->name('category.update');//modal acilmasi ucun verilen route..

   //              PAGES ISLEMLERI                 ----------------
   Route::get('/sayfalar','App\Http\Controllers\Back\PagesController@index')->name('sayfalar.index');
   Route::get('/sayfalar/ekle','App\Http\Controllers\Back\PagesController@create')->name('sayfalar.ekle');
   Route::post('/sayfalar/ekle','App\Http\Controllers\Back\PagesController@createPost')->name('sayfalar.ekleme');
   Route::get('/sayfalar/duzenle/{id}','App\Http\Controllers\Back\PagesController@duzenle')->name('sayfalar.duzenle');
   Route::post('/sayfalar/duzenle/{id}','App\Http\Controllers\Back\PagesController@update')->name('sayfalar.update');
   Route::get('/sayfalar/delete{id}','App\Http\Controllers\Back\PagesController@delete')->name('sayfalar.delete');
   Route::get('/sayfalar/durum','App\Http\Controllers\Back\PagesController@switch')->name('page.switch');
   Route::get('/sayfalar/siralama','App\Http\Controllers\Back\PagesController@orders')->name('page.orders');
   
   //            AYARLAR ISLEMLERI
   Route::get('/ayarlar','App\Http\Controllers\Back\ConfigController@index')->name('ayarlar');
   Route::post('/ayarlar/duzenle{id}','App\Http\Controllers\Back\ConfigController@update')->name('ayarlar.update');
   //           --------------
   Route::get('cikis','App\Http\Controllers\Back\Giris@logout')->name('logout');
});









// ----------------FRONT END -----------  


Route::get('/', 'App\Http\Controllers\Front\Homepage@index')->name('home');
Route::get('sayfa','App\Http\Controllers\Front\Homepage@index');
Route::get('/iletisim','App\Http\Controllers\Front\Homepage@contact')->name('contact');
Route::post('/iletisim','App\Http\Controllers\Front\Homepage@contactpost')->name('contact.post');
Route::get('/kategori/{category}','App\Http\Controllers\Front\Homepage@category')->name('category');
//Route::get('/blog/{slug}','App\Http\Controllers\Front\Homepage@single')->name('single');//bu link vermek ucun verilen addi
/* bu route birinci hal ucun idi.. deyisirik.. edeceyik bele..blog yazisini silirik,yerine hansi categori olacaq ve hansi basliqla..
   public function single($slug)
   {
        //ilkin veziyyet bele idi $data['article']=Article::whereSlug($slug)->first() ?? abort(403,'Bele sehife tapilmadi');//bununla biz url ucun bele bir slug var ya yox onu sorguladiq.. if evezidi.. burda duz olmuyan slug yazilanda xeta sehifesine atir
        $article=Article::whereSlug($slug)->first() ?? abort(403,'Bele sehife tapilmadi');
        $article->increment('hit');//bu oxunma sayi ucun yazilan koddu..her defe girende bir dene artirir
        $data['article']=$article;
         $data['categories']=Categories::inRandomOrder()->get();//yeni sehifede categories xetasi verir deye bunu da elave edirik
         return view('front.single',$data);
   }
   <a href="{{route('single',$xeb->slug)}}">bu linki de deyisdik
   bunlari deyisdik
*/
Route::get('/{category}/{slug}','App\Http\Controllers\Front\Homepage@single')->name('single');//yazilara getmek ucun verilen linkdi..
Route::get('/{sayfa}','App\Http\Controllers\Front\Homepage@page')->name('page');
