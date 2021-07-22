@extends('back.loyout.master')
@section('title','Silinen Meqaleler')
@section('content')
<div class="card shadow mb-4 col-md-12">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">@yield('title')
                            <span class="float-right"><strong>{{$articles->count()}} </strong> meqale tapildi
                            <a href="{{route('admin.meqaleler.index')}}" class="btn btn-info" title="meqaleler"><i class="fas fa-undo-alt"></i></a>
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
                                        
                                            <td>{{$article->created_at->diffForHumans()}}</td>
                                            <td>
                                              <a href="{{route('admin.recorved.article',$article->id)}}" class="btn btn-success" title="geri qaytar"><i class="fas fa-recycle"></i></a>
                                              <a href="{{route('admin.hard.delete.article',$article->id)}}" class="btn btn-danger" title="sil"><i class="fas fa-trash"></i></a>
                                         
                                              </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

@endsection

