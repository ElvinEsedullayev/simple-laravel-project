@isset($categories)
<!-- categories elave olunmuyubsa xeta vermesin..yazmisiq categories varsa bu gostersin -->
<div class="col-md-3 col-lg-3 col-xl-3" style="margin-top: 85px;">
    <div class="card bg-secondary">
        <div class="card-header" style="color: white;">
              Kategoriler
        </div>
            <div class="list-group">
                @foreach($categories as $category)
                <!--Request::segment(2)==$category->slug url olan yerde her / bir segment sayilir..2 ci dropla category slugu beraberdise yazdiq -->
                <li class="list-group-item @if(Request::segment(2)==$category->slug) active @endif">
                        <a @if(Request::segment(2)!==$category->slug) href="{{route('category',$category->slug)}}" @endif  >
                        <!--burda yazdigimiz kod eger girdiyimiz linkdeyikse ora bir de gede bilmirk -->
                        {{$category->name}}
                        </a>
                        <span class="badge bg-danger" style="color:white; float:right;" class="badge badge-primary float-right">{{$category->getArticle()}}
                        </span>   
                </li>
                @endforeach
            </div>
    </div> 
</div>
@endif