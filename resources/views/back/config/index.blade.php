@extends('back.loyout.master')
@section('title','Meqaleler')
@section('content')
<div class="card shadow mb-4 col-md-12">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">@yield('title')
                            </h6>
                        </div>
      <form action="{{route('admin.ayarlar.update',$ayarlar->id)}}" method="post" enctype="multipart/form-data">
          @csrf                  
      <div class="row">
          <div class="col-md-6">
              <div class="form-group">
                  <label for="">Title</label>
                  <input type="text" name="title" value="{{$ayarlar->title}}" class="form-control">
              </div>
          </div>
              <div class="col-md-6">
                <div class="form-group">
                    <label for="">Durum</label>
                    <select name="durum" class="form-control">
                      <option @if($ayarlar->durum==1) selected @endif value="1">Aktiv</option>
                      <option @if($ayarlar->durum==0) selected @endif value="0">Passiv</option>
                    </select>
                </div>
              </div>
      </div>     
      <div class="row">
          <div class="col-md-6">
              <div class="form-group">
                  <label for="">Logo</label>
                  <input type="file"  name="logo" class="form-control">
              </div>
          </div>
          <div class="col-md-6">
              <div class="form-group">
                  <label for="">Favicon</label>
                  <input type="file" name="favicon" class="form-control">
              </div>
          </div>
      </div>        
      <div class="row">
          <div class="col-md-6">
              <div class="form-group">
                  <label for="">Facebook</label>
                  <input type="text" value="{{$ayarlar->facebook}}" name="facebook" class="form-control">
              </div>
          </div>
          <div class="col-md-6">
              <div class="form-group">
                  <label for="">Twitter</label>
                  <input type="text" value="{{$ayarlar->twitter}}" name="twitter" class="form-control">
              </div>
          </div>
      </div>      
      <div class="row">
          <div class="col-md-6">
              <div class="form-group">
                  <label for="">Github</label>
                  <input type="text" value="{{$ayarlar->github}}" name="github" class="form-control">
              </div>
          </div>
          <div class="col-md-6">
              <div class="form-group">
                  <label for="">Linkedin</label>
                  <input type="text" value="{{$ayarlar->linkedin}}" name="linkedin" class="form-control">
              </div>
          </div>
      </div>   
      <div class="row">
          <div class="col-md-6">
              <div class="form-group">
                  <label for="">YouTube</label>
                  <input type="text" value="{{$ayarlar->youtube}}" name="youtube" class="form-control">
              </div>
          </div>
          <div class="col-md-6">
              <div class="form-group">
                  <label for="">Instagram</label>
                  <input type="text" value="{{$ayarlar->instagram}}" name="instagram" class="form-control">
              </div>
          </div>
          
      </div> 
      <div class="row">
              <button type="submit" class="btn btn-primary btn-block ">Guncelle</button>
          </div>
          </form>
 </div>


@endsection