@extends('layouts.front')

@section('content')
    <section class="container">
        <div class="row mb-5">
            <div class="col-sm col-md-8">
                <img src="{{ Storage::url($news['images'][0]->path) }}" alt="" class="w-100 img-fluid mb-4">
                <h3 class="title">{{ $news->main_title }}</h3>
                <p>{!! $news->content !!} </p>
            </div>
            <div class="col-sm col-md-4">
                <h5 class="title font-weight-bold text-uppercase mb-4">you may like</h5>
                @foreach($relatedNews as $news)
                    <div class="card mb-2" style="max-width: 540px;">
                        <div class="row no-gutters">
                            <div class="col-md">
                                <img src="{{ Storage::url($news['images'][0]->path) }}" class="card-img mb-4" alt="...">
                            </div>
                            <div class="col-md">
                                <div class="card-body pt-0">

                                    <a href="{{ route('front.article', $news->id) }}"><h5 class="card-title">{{ $news->main_title }}</h5></a>
                                    <p class="card-text">{{ strip_tags(substr($news->content, 0, 40)).".." }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@stop
