@extends('back.loyout.master')
@section('title','Meqaleler')
@section('content')
<div class="card shadow mb-4 col-md-12">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">@yield('title')
                            <span class="float-right"><strong>{{$articles->count()}} </strong> meqale tapildi
                            <a href="{{route('admin.silinen.article')}}" class="btn btn-warning" title="silinenler"><i class="far fa-trash-alt"></i></a>
                            </span>
                            
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Sekil</th>
                                            <th style="width: 200px;">Basliq</th>
                                            <th>Kategorisi</th>
                                            <th>Hit</th>
                                            <th>Durum</th>
                                            <th>Tarix</th>
                                            <th>Islemler</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach($articles as $article)
                                        <tr>
                                            <td>
                                              <img src="{{asset($article->image)}}" width="200" alt="">
                                            </td>
                                            <td>{{$article->title}}</td>
                                            <td>{{$article->getCategori->name}}</td>
                                            <td>{{$article->hit}}</td>
                                            <td>
                                            <input @if($article->durum ==1) checked @endif name="statu" class="switch" article-id="{{$article->id}}" type="checkbox" data-size="normal" data-on="Aktiv" data-off="Passiv" data-offstyle="danger" data-onstyle="info"  data-toggle="toggle">
                                            <!--
                                              {!!$article->durum==1 ? '<span class="text-success">aktiv</span>' : '<span class="text-danger">passiv</span>'!!} -->
                                            </td>
                                            <td>{{$article->created_at->diffForHumans()}}</td>
                                            <td>
                                              <a href="{{route('single',[$article->getCategori->slug,$article->slug])}}" target="_blank" class="btn btn-success" title="goruntule"><i class="fas fa-eye"></i></a>
                                              <a href="{{route('admin.meqaleler.edit',$article->id)}}" class="btn btn-primary" title="duzenle"><i class="fas fa-pen"></i></a>
                                              <a href="{{route('admin.delete.article',$article->id)}}" class="btn btn-danger" title="sil"><i class="fas fa-trash"></i></a>
                                              
                                              {{--  form ile silmek bu formada olur..crud islemlerinde oz funksiyasi ile bele silinir..
                                              <form action="{{route('admin.meqaleler.destroy',$article->id)}}" method="post">
                                              @csrf
                                              @method('DELETE')
                                              <button style="submit" class="btn btn-danger" title="sil"><i class="fas fa-trash"></i></button>
                                               </form>
                                              --}}
                                             
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
<script>
  $(function() {
    $('.switch').change(function() {
      id= $(this)[0].getAttribute('article-id');//article-id den idni qebul etdik,ve id deyiskenine atdiq
      statu=$(this).prop('checked');
      //alert(statu); return;
      //altdaki jquery get methodu
      $.get("{{route('admin.switch')}}", {id:id,statu:statu} , function(data, status){
          
      });
    })
  })
</script>
@endsection