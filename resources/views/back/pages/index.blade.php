@extends('back.loyout.master')
@section('title','Sayfalar')
@section('content')
<div class="card shadow mb-4 col-md-12">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">@yield('title')
                            <span class="float-right"><strong>{{$pages->count()}} </strong> sayfa tapildi
                           
                            </span>
                            
                            </h6>
                        </div>
                        <div class="card-body">
                          <div id="orderSuccess" style="display:none;" class="alert alert-success">
                            Siralama basarili sekilde guncellendi
                          </div>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th style="width:5px;" class="text-center">Siralama</th>
                                            <th>Sekil</th>{{--yorum satri --}}<!--yorum ..bu gorunur sehife incelenende..o biri yox-->
                                            <th style="width: 200px;">Basliq</th>
                                            <th>Durum</th>
                                            <th>Islemler</th>
                                        </tr>
                                    </thead>
                                    <tbody id="orders">{{--js ucun verilib..sehifelerin yerni deyismek ucundu --}}
                                      @foreach($pages as $page)
                                        <tr id="page_{{$page->id}}">{{--her sehifenin bir id si var,sehifenin id sinin siralamasini deyismek olur,console logda yazilir.. --}}
                                            <td style="width:5px;" class="text-center"><i class="fas fa-arrows-alt handle fa-3x"></i></td>
                                            <td>
                                              <img src="{{asset($page->image)}}" width="200" alt="">
                                            </td>
                                            <td>{{$page->title}}</td>
                                            <td>
                                            <input @if($page->durum ==1) checked @endif name="statu" class="switch" page-id="{{$page->id}}" type="checkbox" data-size="normal" data-on="Aktiv" data-off="Passiv" data-offstyle="danger" data-onstyle="info"  data-toggle="toggle">
                                            </td>
                                            <td>
                                              <a href="{{route('page',$page->slug)}}" target="_blank" class="btn btn-success" title="goruntule"><i class="fas fa-eye"></i></a>
                                              <a href="{{route('admin.sayfalar.duzenle',$page->id)}}" class="btn btn-primary" title="duzenle"><i class="fas fa-pen"></i></a>
                                              <a href="{{route('admin.sayfalar.delete',$page->id)}}" class="btn btn-danger" title="sil"><i class="fas fa-trash"></i></a>
                                              </td>
                                              
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

@endsection
@section('css')
 <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
 @endsection
  @section('js')
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.14.0/Sortable.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script>{{--yuxaroda olan js ile birlikde siralama ucun verilib --}}
  $('#orders').sortable({//tbodye verilen id di
      handle:'.handle',//bu i teqi icinde verilen classdi,yeni ancaq o td olan yerle move ede bilek
      update:function(){
        var siralama = $('#orders').sortable('serialize');
        //console.log(siralama)
        $.get("{{route('admin.page.orders')}}?"+siralama,function(data,status){});//data gonderilir,ve bunu qaRSIlamaq lazim

        $("#orderSuccess").show().delay(2000).fadeOut();//success msji verir
      }
  });
</script>
<script>
  $(function() {
    $('.switch').change(function() {
      id= $(this)[0].getAttribute('page-id');//article-id den idni qebul etdik,ve id deyiskenine atdiq
      statu=$(this).prop('checked');
      //alert(statu); return;
      //altdaki jquery get methodu
      $.get("{{route('admin.page.switch')}}", {id:id,statu:statu} , function(data, status){
          
      });
    })
  })
</script>
@endsection