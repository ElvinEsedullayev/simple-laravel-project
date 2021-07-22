<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ayarlar;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
class ConfigController extends Controller
{
    public function index()
    {
        $ayarlar=Ayarlar::find(1);
        return view('back.config.index',compact('ayarlar'));
    }

    public function update(Request $request)
    {
        $ayarlar = Ayarlar::find(1);
        $ayarlar->title=$request->title;
        $ayarlar->durum=$request->durum;
        $ayarlar->facebook=$request->facebook;
        $ayarlar->twitter=$request->twitter;
        $ayarlar->github=$request->github;
        $ayarlar->linkedin=$request->linkedin;
        $ayarlar->youtube=$request->youtube;
        $ayarlar->instagram=$request->instagram;

        if($request->hasFile('logo')){//bu o demek ki eger sekil yuklenibse
            $logo = Str::slug($request->title).'-logo.'.$request->logo->getClientOriginalExtension();//seklin adini yazdirmaq ucun
            $request->logo->move(public_path('uploads'),$logo);//upload papkasi yaradir ve sekli sekil adi ile ora atir
            $ayarlar->logo='uploads/'.$logo;//bunu article modelindeki tabloya yukluyur
        }

        if($request->hasFile('favicon')){//bu o demek ki eger sekil yuklenibse
            $favican = Str::slug($request->title).'-favicon.'.$request->favicon->getClientOriginalExtension();//seklin adini yazdirmaq ucun
            $request->favicon->move(public_path('uploads'),$favican);//upload papkasi yaradir ve sekli sekil adi ile ora atir
            $ayarlar->favicon='uploads/'.$favican;//bunu article modelindeki tabloya yukluyur
        }
        $ayarlar->save();
        toastr()->success('Ayarlar basarili sekilde guncellendi');
        return redirect()->back();
    }
}
