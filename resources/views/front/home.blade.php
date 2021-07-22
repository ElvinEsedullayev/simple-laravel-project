@extends('front.loyout.master')
@section('title','Anasayfa')

@section('content')
@include('front.widgets.categorywidget')
                <div class="col-md-9 col-lg-9 col-xl-9">
                    <!-- Post preview-->
@include('front.widgets.articleswidgets')
                </div>
@endsection