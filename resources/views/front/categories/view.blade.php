@extends('layouts.front')

@section('content')
    <div class="row">
    @foreach($allNews as $news)
            <div class="col-md-3">
                <div class="ibox">
                    <div class="ibox-content product-box">
                        <div class="product-imitation">
                            <img src="{{count($news->images) > 0 ? Storage::url($news->images[0]->path) : asset('img/default-image.png')}}" alt=""
                                 width="100%" height="150">
                        </div>
                        <div class="product-desc">
                            <small class="text-muted">{{$news['created_at']}}</small>
                            <a href="#" class="product-name"> {{$news['main_title']}}</a>

                            <div class="small m-t-xs">
                                {{ substr(strip_tags($news['content']), 0, 100).'...' }}
                            </div>
                            <div class="m-t text-left">
                                <a href="{{ route('front.article', $news['id']) }}" class="btn btn-xs btn-outline btn-primary">Read <i class="fa fa-long-arrow-right"></i> </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    @endforeach
    </div>
@stop
