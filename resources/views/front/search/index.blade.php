@extends('layouts.front')

@section('content')

    <section class="main-sec">
        <div class="row no-gutters">
            @if(count($result) > 0)
                <div class="col-sm col-md-8 pl-0 mb-5">
                    @foreach($result as $news)
                        <section class="category-news mb-5">
                            <img src="{{ $news->cover ? Storage::url($news->cover->path) : asset('img/default-image.png')}}" alt="" class="w-100 img-fluid mb-4">
                            <a href="{{ route('front.article', $news['id']) }}">
                                <h3>{{$news['main_title']}}</h3>
                            </a>
                            <p class="mb-5">{{ substr(strip_tags($news['content']), 0, 300).'...' }}</p>
                        </section>
                    @endforeach
                </div>
                <div class="offset-md-1 col-sm col-md-3 pl-0">
                    <h5 class="title font-weight-bold text-uppercase mb-4">latest news</h5>
                    @include('includes.SideSection')
                </div>
            @else
                <p>There is no results.</p>
            @endif
        </div>
        {{ $result->links() }}
    </section>

@stop
