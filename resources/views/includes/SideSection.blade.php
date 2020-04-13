<div class="offset-md-1 col-sm col-md-3 pl-0">
    @isset($sideSectionNews)
        @foreach(array_slice($sideSectionNews, 3, 4) as $news)
            <div class="art1 mb-4">
                <img src="{{Storage::url($news['cover']['path'])}}" alt="" class="w-100 img-fluid mb-3">
                <a href="{{ route('front.article', $news['id']) }}"><h5>{{$news['main_title']}}</h5></a>
                <p class='block-with-text'>{!!$news['secondary_title']!!}</p>
            </div>
        @endforeach
    @endisset
</div>
