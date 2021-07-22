@if(count($xeber)>0)
@foreach($xeber as $xeb)
<div class="post-preview">
    <a href="{{route('single',[$xeb->getCategori->slug,$xeb->slug])}}">
        <h2 class="post-title">{{$xeb->title}}</h2>
            <img src="{{$xeb->image}}" alt="" width="800" height="400">
        <h3 class="post-subtitle">{!!Str::limit($xeb->article,120)!!}</h3>
    </a>
    <p class="post-meta">
        Category : 
        <a href="{{route('single',[$xeb->getCategori->slug,$xeb->slug])}}">{{$xeb->getCategori->name}}</a>
            <span style="float: right">{{$xeb->created_at->diffForHumans()}}</span>

    </p>
</div>
<!-- Divider-->
@if(!$loop->last)
<hr class="my-4" />
@endif
@endforeach
<div class="d-flex justify-content-center">
   {{$xeber->links()}}
   <!--sayfalandiram pagination ucun yazilan koddu -->
</div>
@else
<div class="alert alert-danger">
    <h1>Bele bir yazi tapilmadi</h1>
</div>
@endif