<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;//yazdigimiz modeli elave edirik
use Illuminate\Support\Str;//slug ucun bu kitabxanani elave edirik
use Illuminate\Support\Facades\File;//fileni istifade etmek ucun istifade olunur..papkada olan sekli silmek
class PagesController extends Controller
{
    public function index()
    {
        $pages=Page::all();
        return view('back.pages.index',compact('pages'));
    }

    public function switch(Request $request)
    {
        $page=Page::findOrFail($request->id);//js dan gelen id ni tapmaq ucun yazilib
        
        $page->durum=$request->statu=="true" ? 1 : 0;
        
        $page->save();
    }

    public function create()
    {
        return view('back.pages.create');
    }

    public function createPost(Request $request)
    {
        $request->validate([
            'title'=>'required |min:3',
            'image'=>'required|image|mimes:jpg,jpeg,phg|max:4096'
        ]);
        $sira = Page::orderBy('order','DESC')->first();//orderin axrinci reqemini aliriq
        
        $pages = new Page;
        $pages->title=$request->title;
        $pages->content=$request->icerik;
        $pages->order=$sira->order+1;//orderin axrinci reqeminin ustune gelirik
        $pages->slug=Str::slug($request->title);

        if($request->hasFile('image')){//bu o demek ki eger sekil yuklenibse
            $imagename = Str::slug($request->title).'.'.$request->image->getClientOriginalExtension();//seklin adini yazdirmaq ucun
            $request->image->move(public_path('uploads'),$imagename);//upload papkasi yaradir ve sekli sekil adi ile ora atir
            $pages->image='uploads/'.$imagename;//bunu article modelindeki tabloya yukluyur
        }
        $pages->save();
        toastr()->success('Basarili sekilde sayfa yuklendi');
        return redirect()->route('admin.sayfalar.index');
    }

    public function duzenle($id)
    {
        $page=new Page;
        $page=Page::findOrFail($id);
        return view('back.pages.update',compact('page'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'title'=>'required |min:3',
            'image'=>'required|image|mimes:jpg,jpeg,phg|max:4096'
        ]);
        $sira = Page::orderBy('order','DESC')->first();//orderin axrinci reqemini aliriq
        
        $pages =Page::findOrFail($id);
        $pages->title=$request->title;
        $pages->content=$request->icerik;
        $pages->order=$sira->order+1;//orderin axrinci reqeminin ustune gelirik
        $pages->slug=Str::slug($request->title);

        if($request->hasFile('image')){//bu o demek ki eger sekil yuklenibse
            $imagename = Str::slug($request->title).'.'.$request->image->getClientOriginalExtension();//seklin adini yazdirmaq ucun
            $request->image->move(public_path('uploads'),$imagename);//upload papkasi yaradir ve sekli sekil adi ile ora atir
            $pages->image='uploads/'.$imagename;//bunu article modelindeki tabloya yukluyur
        }
        $pages->save();
        toastr()->success('Basarili sekilde sayfa guncellendi');
        return redirect()->route('admin.sayfalar.index');
    }

    public function delete($id)
    {
        $page=Page::find($id);
        if(File::exists($page->image)){//seklin olub olmadigini control edir
            File::delete(public_path($page->image));
        }
        toastr()->success('Basarili','  Sayfa ugurla silindi');
        return redirect()->route('admin.sayfalar.index');
    }

    public function orders(Request $request)//pages sehifesinde yeni sehifelerde yazilan sehifelerin yerini deyisib yenilemek
    {
        //burda yazilan order sql icinde olan table adidi..order siralam tablosu yeni
        foreach($request->get('page') as $key => $order){
            Page::where('id',$order)->update(['order'=>$key]);//
        }
    }
}
