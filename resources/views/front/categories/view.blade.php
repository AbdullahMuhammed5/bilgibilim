@extends('layouts.front')

@section('content')

    <!--  main section  -->
    <section class="main-sec">
        <div class="row no-gutters">
            <div class="col-sm col-md-8 pl-0 mb-5">
                @foreach($allNews as $news)
                <section class="category-news mb-5">
                    <img src="{{count($news->images) > 0 ? Storage::url($news->images[0]->path) : asset('img/default-image.png')}}" alt="" class="w-100 img-fluid mb-4">
                    <a href="{{ route('front.articles', $news['id']) }}">
                        <h3>{{$news['main_title']}}</h3>
                    </a>
                    <p class="mb-5">{{ substr(strip_tags($news['content']), 0, 300).'...' }}</p>
                </section>
                @endforeach
            </div>
            @include('includes.SideSection')
        </div>
        {{ $allNews->links() }}
    </section>
    <!-- end of main section -->

    <!-- categories section -->
    <section class="category">
        <h2 class="title mb-5 text-uppercase font-weight-bold">other categories</h2>
        <div class="row img-art mb-5">
            @foreach($otherCategories as $category)
            <div class="col-sm col-md-6 col-lg-3 img-over">
                <a href="{{ route('front.category', $category->name) }}">
                    <figure><img src="{{ asset("img/front/category-".strtolower($category->name).".jpg") }}" alt=""
                                 class="w-100 img-fluid mb-3">
                    </figure>
                    <div class="overlay">
                        <h6 class="text-uppercase">{{$category->name}}</h6>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </section>
    <!-- end of categories section -->
@stop
