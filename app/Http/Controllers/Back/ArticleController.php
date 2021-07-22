<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;//yazdigimiz modeli elave edirik
use App\Models\Categories;//yazdigimiz modeli elave edirik
use Illuminate\Support\Str;//slug ucun bu kitabxanani elave edirik
use Illuminate\Support\Facades\File;//fileni istifade etmek ucun istifade olunur..papkada olan sekli silmek
//use Illuminate\Support\Facades\Storage;
class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()//
    {
        $articles= Article::orderBy('created_at','ASC')->get();
        return view('back.article.index',compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()//crud ile melumat yukleme sehifesine getmek
    {
        $categories=Categories::all();
        return view('back.article.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)//crud ile melumat yuklemek
    {
        $request->validate([
            'title'=>'required |min:3',
            'image'=>'required|image|mimes:jpg,jpeg,png |max:4096'
        ]);
        $article = new Article;
        $article->title=$request->title;
        $article->cat_id=$request->categori;
        $article->article=$request->icerik;
        $article->slug=Str::slug($request->title);
        
        if($request->hasFile('image'))//bu o demek ki eger sekil yuklenibse
        {
            $imagename = Str::slug($request->title).'.'.$request->image->getClientOriginalExtension();//seklin adini yazdirmaq ucun
            $request->image->move(public_path('uploads'),$imagename);//upload papkasi yaradir ve sekli sekil adi ile ora atir
            $article->image='uploads/'.$imagename;//bunu article modelindeki tabloya yukluyur
        }
        $article->save();//yukledi
        toastr()->success('Basarili!', 'Meqale ugurla yuklendi!');
        return redirect()->route('admin.meqaleler.index');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)//crud ile yenileme sehifesine getmek
    {
        $article = new Article;
        $article=Article::findOrFail($id);
        $categories=Categories::all();
        return view('back.article.update',compact('categories','article'));
    }

   
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)//crud ile melumat yenilemek
    {
        $request->validate([
            'title'=>'min:3',
            'image'=>'image|mimes:jpg,jpeg,png |max:4096'
        ]);

        $article = Article::findOrFail($id);
        $article->title=$request->title;
        $article->cat_id=$request->categori;
        $article->article=$request->icerik;
        $article->slug=Str::slug($request->title);

        if($request->hasFile('image'))//bu o demek ki eger sekil yuklenibse
        {
            $imagename = Str::slug($request->title).'.'.$request->image->getClientOriginalExtension();//seklin adini yazdirmaq ucun
            $request->image->move(public_path('uploads'),$imagename);//upload papkasi yaradir ve sekli sekil adi ile ora atir
            $article->image='uploads/'.$imagename;//bunu article modelindeki tabloya yukluyur
        }
        $article->save();//yukledi
        toastr()->success('Basarili!', 'Meqale ugurla guncellendi!');
        return redirect()->route('admin.meqaleler.index');
    }

    public function switch(Request $request)//durumu duzeltmek js ile gelen id ile duzenlemek
    {
       
        $article=Article::findOrFail($request->id);//js dan gelen id ni tapmaq ucun yazilib
        
        $article->durum=$request->statu=="true" ? 1 : 0;
        
        $article->save();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)//melumati silmek ve silinen papkaya atmaq
    {
        Article::find($id)->delete();
        toastr()->success('Basarili','Meqale ugurla silinenler sehifesine atildi');
        return redirect()->route('admin.meqaleler.index');
    }


    public function trashed()//silinen fayllari gostermek
    {
        $articles=Article::onlyTrashed()->orderBy('deleted_at','ASC')->get();//onlytrashed ile silinen fayllari gosterir
        return view('back.article.trashed',compact('articles'));
    }


    public function recorved($id)//silinen melumati geri gondermek
    {
        Article::onlyTrashed()->find($id)->restore();//silinen melumati geri dondurur restore
        toastr()->success('Basarili','Meqale ugurla geri qaytarildi');
        return redirect()->back();//back oz sehifesine geri dondurur
    }
    public function hardDelete($id)//melumati temiz silmek
    {
        $article=Article::onlyTrashed()->find($id);//onlytarshed yazmaq lazimdi ki,tapsin hansini silir..yuxarda adi deleete yazmiriq calisir
        if(File::exists($article->image))//seklin olub olmadigini control edir
        {
            File::delete(public_path($article->image));//varsa eger public path ile seklin yolunu ve sekli sildiririk
        }
        $article->forceDelete();//temiz silmek ucundu...sekli papkadan silmek ucun yazilan koddan qaabaq bu find arxxasindan yazilmisdi
        toastr()->success('Basarili','Meqale ugurla silindi');
        return redirect()->route('admin.meqaleler.index');
    }




    public function destroy($id)
    {
        return $id;
    }
}
