@extends('layouts.front')

@section('content')

    <!--  main section  -->
    <section class="main-sec">
        <div class="row no-gutters">
            @if(count($allNews) > 0)
            <div class="col-sm col-md-8 pl-0 mb-5">
                @foreach($allNews as $news)
                <section class="category-news mb-5">
                    <img src="{{ $news->cover ? Storage::url($news->cover->path) : asset('img/default-image.png')}}" alt="" class="w-100 img-fluid mb-4">
                    <a href="{{ route('front.article', $news['id']) }}">
                        <h3>{{$news['main_title']}}</h3>
                    </a>
                    <p class="mb-5">{!! substr(strip_tags($news['content']), 0, 300).'...' !!} </p>
                </section>
                @endforeach
            </div>
            <div class="offset-md-1 col-sm col-md-3 pl-0">
                <h5 class="title font-weight-bold text-uppercase mb-4">latest news</h5>
                @include('includes.SideSection')
            </div>
            @else
                <p>There is no articles in this category.</p>
            @endif
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
                    <figure><img src="{{ $category->cover ? Storage::url($category->cover->path) : asset("img/front/category-".strtolower($category->name).".jpg") }}" alt=""
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
