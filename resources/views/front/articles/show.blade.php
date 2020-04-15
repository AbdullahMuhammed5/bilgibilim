@extends('layouts.front')

@section('content')
    <section class="container">
        <div class="row mb-5">
            <div class="col-sm col-md-8">
                <h3 class="title">{{ $news->main_title }}</h3>
                <p class="text-muted">{{ $news->secondary_title }}</p>
                <div id="articleSliderCarousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#articleSliderCarousel" data-slide-to="0" class="active"></li>
                    </ol>
                    <div class="carousel-inner" role="listbox" id="article-slider">
                        <div class="carousel-item active">
                            <img src="{{Storage::url($news->cover['path'])}}" class="d-block w-100 mb-4">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#articleSliderCarousel" role="button"
                       data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#articleSliderCarousel" role="button"
                       data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <p class="text-muted p-2" style="border-left: #8f8fa1 solid 1px; border-right: #8f8fa1 solid 1px;">
                    <i class="fa fa-calendar"> </i>
                    {{ $news->created_at? $news->created_at->diffForHumans():'' }} -
                    <i class="fa fa-eye"> </i>
                    {{ $news->views }} views
                </p>
                <div id="article-content">{!! $news->content !!} </div>
            </div>
            <div class="col-sm col-md-4">
                <h5 class="title font-weight-bold text-uppercase mb-4">you may like</h5>
                @foreach($relatedNews as $related)
                    <div class="card mb-2" style="max-width: 540px;">
                        <div class="row no-gutters">
                            <div class="col-md-5">
                                <img src="{{ Storage::url($related->cover->path) }}" class="card-img mb-4" alt="...">
                            </div>
                            <div class="col-md-7">
                                <div class="card-body pt-0">
                                    <a href="{{ route('front.article', $related->id) }}"><h5 class="card-title">{{ $related->main_title }}</h5></a>
                                    <p class="card-text">{{ strip_tags(substr($related->content, 0, 40)).".." }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>
@stop

@push('article-slider')
    <script>
        $(function () {
            const parent = document.querySelector('#article-slider');
            const carouselIndicators = document.querySelector('.carousel-indicators');
            const images = [...document.querySelectorAll('#article-content img')]; // from nodeList to array
            const carouselItems = images.map((img, index) => {
                    carouselIndicators.innerHTML += `<li data-target="#articleSliderCarousel" data-slide-to="${index+1}"></li>`;
                    return `<div class="carousel-item">
                                <img src="${img.src}" class="d-block w-100 mb-4">
                            </div>`
                }).join('');
            parent.innerHTML += carouselItems;
        })
    </script>
@endpush

