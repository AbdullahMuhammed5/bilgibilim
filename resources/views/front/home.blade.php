@extends('layouts.front')

@section('content')

<section class="container">
    <!--  main section  -->
    <section class="main-sec">
        <h2 class="title mb-5 text-uppercase font-weight-bold">Today News</h2>
        <div class="row no-gutters mb-5">
            <div class="col-sm col-md-8 pl-0">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleControls" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleControls" data-slide-to="1"></li>
                        <li data-target="#carouselExampleControls" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        @isset($sliderNews)
                            @foreach($sliderNews as $key=>$news)
                                <div class="carousel-item @if($news == $sliderNews[0]) active @endif">
                                    <a href="{{ route('front.article',  $news['id'])}}">
                                        <img src="{{Storage::url($news['images'][0]['path'])}}" class="d-block w-100 mb-4">
                                        <h3>{{$news['main_title']}}</h3>
                                    </a>
                                    <p class='block-with-text'>{{ $news['secondary_title'] }}</p>
                                </div>
                            @endforeach
                        @endisset
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button"
                       data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button"
                       data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
           @include('includes.SideSection')
        </div>
    </section>
    <!-- end of main section -->

    <!-- en cok oku   -->
    <section class="en-cok-oku">
        <h2 class="title mb-5 text-uppercase font-weight-bold">Most Read</h2>
        <div class="regular">
            @isset($mostViews)
                @foreach($mostViews as $article)
                    <a href="{{ route('front.article', $article->id )}}">
                        <figure>
                            <img src="{{Storage::url($article['images'][0]->path)}}"
                                 class="w-100 img-fluid mb-3" alt="{{$article->main_title}}">
                            <figcaption>{{$article->main_title}}</figcaption>
                        </figure>
                    </a>
                @endforeach
            @endisset
        </div>
    </section>
    <!-- end en cok   -->

    <!-- categories section -->
    <section class="categories">
        <h2 class="title mb-5 text-uppercase front-weight-bold">categories</h2>
        <div class="row img-art mb-5">
            @isset($categoriesSection)
                @foreach($categoriesSection as $name=>$category)
                    <div class="col-lg-3 col-sm-6">
                        <div class="img-over">
                            <a href="{{ route('front.category', $name) }}">
                                <figure class="w-100"><img src="{{asset("img/front/category-".strtolower($name).".jpg")}}" alt=""
                                             class="w-100 img-fluid mb-3">
                                </figure>
                                <div class="overlay">
                                    <h6 class="text-uppercase">{{$name}}</h6>
                                </div>
                            </a>
                        </div>
                    @foreach($category as $news)
                        <div class="card col-sm col-md-6 col-lg-3 border-bottom mb-3" style="max-width: 540px;">
                            <div class="row no-gutters mb-3 ">
                                <div class="col-md-4">
                                    <img src="{{Storage::url($news['images'][0]->path)}}" class="card-img w-100 mt-3"
                                         alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body ">
                                        <p class="mb-0">{{$news->main_title}}</p>
                                        <p class="card-text"><small class="text-muted">{{ $news->created_at->diffForHumans() }}</small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </div>
                @endforeach
            @endisset
        </div>
    </section>
    <!-- end of categories section -->

    <!-- world section  -->
    <section class="world">
        <h2 class="title mb-5 text-uppercase front-weight-bold">world news</h2>
        <div class="row">

            @isset($worldNews)
                @isset($worldNews[0])
                <div class="col-sm col-md-6">
                    <img src="{{Storage::url($worldNews[0]['images'][0]['path'])}}" alt="" class="w-100 img-fluid mb-3">
                    <h5 class="card-title">{{$worldNews[0]['main_title']}}</h5>
                    <p class="card-text">{{$worldNews[0]['secondary_title']}}</p>
                </div>
                @endisset
                <div class="col-sm col-md-6">
                    @foreach(array_slice($worldNews, 1, 3) as $news)
                    <div class="card mb-5" style="max-width: 540px;">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <img src="{{Storage::url($news['images'][0]['path'])}}" class="card-img mb-3" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body pt-0">
                                    <h5 class="card-title">{{$news['main_title']}}</h5>
                                    <p class="card-text">{{$news['secondary_title']}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endisset
        </div>
    </section>
    <!-- end of world section -->
</section>

@stop
