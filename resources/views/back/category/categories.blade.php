@extends('back.loyout.master')
@section('title','Categoriler')
@section('content')
<div class="card shadow mb-4 col-md-4">

                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Category Olusturma Formu</h6>
                        </div>
                        <div class="card-body">
                    
                           <form action="{{route('admin.category.create.index')}}" method="post">
                           @csrf
                           <div class="form-group">
                                <label for="">Category Adi</label>
                                <input type="text" name="title" class="form-control">
                           </div>
                           <div class="form-group">
                           <button class="btn btn-primary btn-block" type="submit">Category Olustur</button>
                           </div>
                           </form>
                        </div>
                    </div> 
<div class="card   col-md-8">  
              <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">@yield('title')
                            <span class="float-right"><strong>{{$categories->count()}} </strong> category tapildi
                            
                            </span>
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Category</th>
                                            <th>Meqale Sayi</th>
                                            <th>Durum</th>
                                            <th style="text-align: center;">Islemler</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach($categories as $category)
                                        <tr>
                                           
                                            <td>{{$category->name}}</td>
                                            <td>{{$category->getArticle()}}</td><!--modulda bunun ucun funksiya yazmisiq..sayi gosterir -->
                                            <td>
                                            <input @if($category->durum ==1) checked @endif name="statu" class="switch" category-id="{{$category->id}}" type="checkbox" data-size="normal" data-on="Aktiv" data-off="Passiv" data-offstyle="danger" data-onstyle="info"  data-toggle="toggle">
                                            </td>
                                            
                                            <td style="text-align: center;">
                                            <a category-id="{{$category->id}}" title="Categori guncelle" class="btn btn-primary edit-click"><i class="fa fa-edit"></i></a>
                                            <a category-id="{{$category->id}}" category-name="{{$category->name}}" category-count="{{$category->getArticle()}}" title="Categori sil" class="btn btn-danger remove-click"><i class="fa fa-times"></i></a>
                                            <!--category-count="{{$category->getArticle()}}" getarticle article modelinde yazdigimiz koddu,hansiki ne qeder article yeni xeber var onu gosterir...burda ise categorisinde article olub olmamaasini yoxluyuruq..yeni varsa silende o article meqaleni basqa bir categoriyeye atsin ki, xeta vermesin -->
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>

<!-- Modal -->
<div id="editModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title">Category Duzenle</h4>
      </div>
      <div class="modal-body">
        <form action="{{route('admin.category.duzenle')}}" method="post">
        @csrf
        <div class="form-group">
        <label for="">Category</label><br>
        <input type="text" name="category" id="category" class="form-control">
        <input type="hidden" name="id" id="cat_id" class="form-control">
        </div>
        <div class="form-group">
        <label for="">Slug</label><br>
        <input type="text" name="slug" id="slug" class="form-control">
        </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
        <button type="submit" class="btn btn-primary">Kaydet</button>
      </div>
      </form>
    </div>

  </div>
</div>                

<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>

<!-- Modal -->
<div id="deleteModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title">Category Sil</h4>
      </div>
      <div id="body" class="modal-body">
        <div class="alert alert-danger" id="articleAlert">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        <form action="{{route('admin.category.delete')}}" method="post">
        @csrf
        <input type="hidden" name="id" id="deleteid">
        <button id="deleteButton" type="submit" class="btn btn-danger">Sil</button>
      </div>
      
    </div>
    </form>
  </div>
</div>               

@endsection
@section('css')
 <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
 @endsection
  @section('js')
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script>
  $(function() {
    //3ci
    $('.remove-click').click(function(){
      //alert("baslidi"); burda yoxladiq verdiyimiz id ni ala bilirik ya yox
      id= $(this)[0].getAttribute('category-id');
      count= $(this)[0].getAttribute('category-count');//categori countda nece meqale var onu aldq
      //alert(count);
      name= $(this)[0].getAttribute('category-name');
      if(id==1){//yeni categori ekledik..id si 1di..ve biz ele edirik ki,o categoris siline bilmez
        $('#articleAlert').html(name+' categorisi sabit categoridir. Silinen diger meqaleler bura eklenecek.');
        $('#body').show();//doludusa verilen xeta msj goreunsun
        $('#deleteButton').hide();
        $('#deleteModal').modal();
        return;
      }
      $('#deleteButton').show();
      $('#deleteid').val(id);//modelde sil buttonu yaninda gizli inputa verilen id adidi,valuesi ise id yeni name
      $('#articleAlert').html();//ifden once yaziriq ki,categorisinde article meqale olmuyanda msj gostermesin modelde
      $('#body').hide();//categorinin ici bosdusa body gorunmesin..bu modelde div bodysine verdiyimiz id nin adidi body..
      if(count>0){
          $('#articleAlert').html('Bu categoriye aid '+count+' meqale tapildi. Silmek istediyinize eminmisiniz?');
          $('#body').show();//doludusa verilen xeta msj goreunsun
      }
      $('#deleteModal').modal();
    });//3ci




    //2ci
    $('.edit-click').click(function(){
      //alert("baslidi"); burda yoxladiq verdiyimiz id ni ala bilirik ya yox
      id= $(this)[0].getAttribute('category-id');
      //console.log(id);yoxladiq verilen id duz gosterir ya yox
      //bu id ni gedib veritabaninda sorguluyuruq,ordan gelen datani modele atiriq..yeni idni categoriler tablosuna gonderdik,varmi dedik,tapildisa o cat bilgileri bize gonderir,bizde modelimize yaziriq..biz de bu deyisiklikleri forma gonderirik
      $.ajax({
        type: 'GET',
        url: '{{route('admin.category.update')}}',
        data: {id:id},
        success: function(data){
          //consele.log(data);
          $('#category').val(data.name);
          $('#slug').val(data.slug);//bu ve yuxaridaki modalin icinde olan formdan gelen input adlaridi
          $('#cat_id').val(data.id);//hidden inputu ile olan veriler
          $('#editModal').modal();//idye verilen addi editModal..yuxarida modal basliginda verilib...bunu yazaraq duzenle buttonuna vuranda modal acilir ve form gelir
        }
      });
    });//2ci

    $('.switch').change(function() { //1ci funksiya
      id= $(this)[0].getAttribute('category-id');//article-id den idni qebul etdik,ve id deyiskenine atdiq
      statu=$(this).prop('checked');
      //alert(statu); return;
      //altdaki jquery get methodu
      $.get("{{route('admin.durum.switch')}}", {id:id,statu:statu} , function(data, status){
          });
    })//1
  })
</script>
@endsection