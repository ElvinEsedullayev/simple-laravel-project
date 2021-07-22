
@extends('front.loyout.master')
@section('title',$article->title)
@section('bg',$article->image)
<!-- 
        birinci bele idi.. buda hec bir sehife olmadiqda blog sayti yazir..hansi sehifeye gedirikse onun adini yazir 
-->
@section('content')
@include('front.widgets.categorywidget')
                <div class="col-md-9 col-lg-9 col-xl-9">
                      {!!$article->article!!}
                      <!--http://www.unit-conversion.info/texttools/text-to-html/
                    bu linkde sekilli metnleri copy edirik ve alinan metni yaziriq..sehifede sekilnen bir yerde gostermek ucun !! !! bele yaziriq...bunu fiqurlu moterize icinde yaziriq

                    
                    -->
                     <p style="color: red">Oxunma sayi : <b>{{$article->hit}}</b></p>
                </div>
                    
@endsection
    