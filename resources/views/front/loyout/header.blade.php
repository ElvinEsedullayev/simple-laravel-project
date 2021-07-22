<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>@yield('title','Blog Sayti') - {{$ayarlar->title}}</title>
        
        <link rel="icon" type="image/x-icon" href="{{asset('front/')}}/assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{asset('front/')}}/css/styles.css" rel="stylesheet" />
        <link rel="shortcut icon" href="{{asset($ayarlar->favicon)}}" type="image/png" />
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="{{route('home')}}">
                    @if($ayarlar->logo !=null)
                    <img src="{{asset($ayarlar->logo)}}" width="100" alt="">
                    @else
                    {{$ayarlar->title}}
                    @endif
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto py-4 py-lg-0">
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="{{route('home')}}">Home</a></li>
                      
                        @foreach($pages as $page)
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="{{route('page',$page->slug)}}">{{$page->title}}</a></li>
                        @endforeach
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="{{route('contact')}}">Contact</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Page Header
    header class="masthead" style="background-image: url('{{asset('front/')}}/img/home-bg.jpg')">
    https://www.hizirogluplastik.com/uploads/sayfalar/large/vizyonumuz.jpg
    
    -->
        <header class="masthead" style="background-image: url('@yield('bg',asset('front/img/vizyonumuz.jpg'))')">
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-12 col-lg-12 col-xl-12">
                        <div class="site-heading">
                            <h1>@yield('title')</h1>
                            
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main Content-->
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">