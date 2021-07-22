<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories;//yazdigimiz modeli elave edirik
use App\Models\Article;//yazdigimiz modeli elave edirik
use Illuminate\Support\Str;//slug ucun bu kitabxanani elave edirik
class CategoryController extends Controller
{

                        // -------------------------- //
    public function index()
    {
        $categories=Categories::all();
        return view('back.category.categories',compact('categories'));
    }

                        // -------------------------- //

    public function switch(Request $request)
    {
        $categories=Categories::findOrFail($request->id);
        $categories->durum=$request->statu=="true" ? 1 : 0;
        $categories->save();
    }

                            // -------------------------- //

    public function create(Request $request)
    {
        $isExists=Categories::whereSlug(Str::slug($request->title))->first();//burda categories modulundan db se baglandi,yeni categories tablosuna,where ile hansi sutunda gelen basliqla verilen sorgudu.. yeni sluq sutunundaki ad ile requestden gelen yeni formdan gelen title eynidise sertimizi yaziriq
        if($isExists)//eger birdise xeta mezaji veririk..eyni adli kategoriya yarada bilmeyek deye
        {
            toastr()->error($request->title.' adinda categori zaten var');
            return redirect()->back();
        }
        $categories = new Categories;
        $categories->name=$request->title;
        $categories->slug=Str::slug($request->title);

        $categories->save();
        toastr()->success('Basarili','Categori basarili sekilde yuklendi');
        return redirect()->back();

    }

                        // -------------------------- //

    public function duzenle(Request $request)//categori duzenlemek
    {
        //eyni olmamasini kontrol edirik..yeni var olan adda bir nese etmek olmasin
        $isExistsSlug=Categories::whereSlug(Str::slug($request->slug))->whereNotIn('id',[$request->id])->first();
        //whereNotIn kodu ile girdiyimiz duzenlemesini istediyimiz categorini nezere almamasini istedik..yeni meselen spor guncellenmesine girdikse sporu nezere almasin..orda deyisiklik ede bilek. bunu yazmasaq meselen spor olan guncellenmede spor gunu ede bilmirik..sporu nezere alir
        $isExistsName=Categories::whereName($request->category)->whereNotIn('id',[$request->id])->first();

        if($isExistsSlug or $isExistsName)
        {
            toastr()->error($request->title.' adinda categori zaten var');
            return redirect()->back();
        }
        $categories = Categories::find($request->id);//hansi idli verini duzenliye bilmeyimizi bilmek ucun hidden ile bir input gonderdik..id ni ordan gonderdik..burda da o id ni qebul etdik
        $categories->name=$request->category;
        $categories->slug=Str::slug($request->slug);
        $categories->save();
        toastr()->success('Basarili','Category basarili sekilde duzenlendi');
        return redirect()->back();
    }

                        // -------------------------- //


    public function update(Request $request)//categori duzenlemesi ucun yazilib..ajax ile veriler gelir
    {
        $categories=Categories::findOrFail($request->id);
        return response()->json($categories);
    }

                        // -------------------------- //


    public function delete(Request $request)
    {
        $categories=Categories::findOrFail($request->id);//categorini tapiriq
        if($categories->id==1){
            toastr()->danger('Xeta','Bu categori siline bilmez');
            return redirect()->back();
        }
        $count=$categories->getArticle();
        $message='';
        if($count>0){//cateqorisinde meqale olanlarin sorgusu,varsa eger bu sertin ici isleyir
            Article::where('cat_id',$categories->id)->update(['cat_id'=>1]);
            $defaultCategory=Categories::find(1);
            $message='Bu kategoriye aid '.$count.' meqale '.$defaultCategory->name.' adli categoriye tasindi.';
        }
        $categories->delete();
        toastr()->success($message,'Categori basarili sekilde silindi');
        return redirect()->back();
    }

}
