
@extends('front.loyout.master')
@section('title','Iletisim Sayfasi')
@section('bg','https://www.proictconsulting.com/wp-content/uploads/2021/04/Contact.jpg')
<!-- 
        birinci bele idi.. buda hec bir sehife olmadiqda blog sayti yazir..hansi sehifeye gedirikse onun adini yazir 
-->
@section('content')

                <div class="col-md-9 col-lg-9 col-xl-9">
                  @if(session('success'))
                    <div class="alert alert-success">
                      {{session('success')}}
                    </div>
                    @endif
                    @if ($errors->any())
                      <div class="alert alert-danger">
                          <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                    @endif
                
                        <h2 align="center" class="text-info">Elaqe yaratmaq ucun bize mesajinizi gonderin</h2>
                        <div class="my-5">
                            <form method="post" action="{{route('contact.post')}}">
                              @csrf
                                <div class="form-group">
                                <label for="inputName">Ad Soyad</label>
                                    <input class="form-control" name="adsoyad" type="text" placeholder="Ad ve Soyadinizi yazin..." />
                                   
                                </div><br>
                                <div class="form-group">
                                <label for="inputEmail">Email addres</label>
                                    <input class="form-control" name="email" type="email" placeholder="Email adresinizi yazin..." />
                                   
                                </div><br>
                              
                                  <div class="form-group">
                                <label>Konu</label>
                                    <select class="form-control" name="top">
                                      <option value="bilgi">Bilgi</option>
                                      <option value="teklif">Teklif</option>
                                      <option value="genel">Genel</option>
                                    </select>
                               
                                </div><br>
                                <div class="form-group">
                                <label>Mesaj</label>
                                    <textarea class="form-control" name="mesaj" placeholder="Mesajinizi yazin..." style="height: 12rem"></textarea>
                                    
                                </div>
                                <br />
                                <button class="btn btn-primary text-uppercase" type="submit">Send</button>
                            </form>
                
                </div>
                    
@endsection
    