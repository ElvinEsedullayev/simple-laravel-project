@extends('back.loyout.master')
@section('title','Meqalele Olustur')
@section('content')
<div class="card shadow mb-4 col-md-12">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Meqale Olusturma Formu</h6>
                            <h6 class="m-0 font-weight-bold text-primary float-right"> Meqale</h6>
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
                           <form action="{{route('admin.meqaleler.store')}}" method="post" enctype="multipart/form-data">
                           @csrf
                           <div class="form-group">
                                <label for="">Meqale Basliq</label>
                                <input type="text" name="title" class="form-control">
                           </div>
                             <div class="form-group">
                                <label for="">Meqale Categori</label>
                                <select name="categori" id="" class="form-control">
                                <option value="">Kategori Sec</option>
                                @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                                </select>
                           </div>
                           <div class="form-group">
                                <label for="">Meqale Sekil</label>
                                <input type="file" name="image" class="form-control">
                           </div>
                           <div class="form-group">
                                <label for="">Meqale Icerik</label>
                                <textarea id="summernote" type="text" name="icerik" class="form-control" rows="4"></textarea>
                           </div>
                           <div class="form-group">
                           <button class="btn btn-primary btn-block" type="submit">Meqale Olsutur</button>
                           </div>
                           </form>
                        </div>
                    </div>
  @section('css')
 <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
 @endsection
  @section('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
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