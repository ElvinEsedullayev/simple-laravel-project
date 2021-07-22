@extends('back.loyout.master')
@section('title',$page->title.' guncellenmesi')
@section('content')
<div class="card shadow mb-4 col-md-12">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Sayfa Olusturma Formu</h6>
                            <h6 class="m-0 font-weight-bold text-primary float-right"> Sayfa</h6>
                        </div>
                        <div class="card-body">
                        @if ($errors->any())
                      <div class="alert alert-danger">
                         <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                         </ul>
                      </div>
                    @endif
                           <form action="{{route('admin.sayfalar.update',$page->id)}}" method="post" enctype="multipart/form-data">
                           @csrf
                           <div class="form-group">
                                <label for="">Sayfa Basliq</label>
                                <input type="text" value="{{$page->title}}" name="title" class="form-control">
                           </div>
                     
                           <div class="form-group">
                                <label for="">Sayfa Sekil</label><br>
                                <img src="{{asset($page->image)}}" width="300" class="rounded img-thumbnail" alt="">
                                <input type="file" name="image" class="form-control">
                           </div>
                           <div class="form-group">
                                <label for="">Sayfa Icerik</label>
                                <textarea id="summernote" type="text" name="icerik" class="form-control" rows="4">{!!$page->content!!}</textarea>
                           </div>
                           <div class="form-group">
                           <button class="btn btn-primary btn-block" type="submit">Sayfa Guncelle</button>
                           </div>
                           </form>
                        </div>
                    </div>
  @section('css')
 <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
 <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
 @endsection


  @section('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script>
$(document).ready(function() {
  $('#summernote').summernote(
       {
            'height':300
       }
  );
});
</script>
 @endsection
@endsection