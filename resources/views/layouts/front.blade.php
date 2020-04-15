<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="News website">
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9" />

    <title>Bilgibilim</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('front_styles/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Animation CSS -->
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{asset('front_styles/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('front_styles/css/slick-theme.css')}}" rel="stylesheet">
    <link href="{{asset('front_styles/css/slick.css')}}" rel="stylesheet">
</head>
<body id="page-top" class="landing-page no-skin-config">
<nav class="navbar navbar-expand-lg navbar-dark primary-color">
    <a href="{{route('home')}}" class="navbar-brand logo order-1 mx-auto">
        <img class="col-md-10" src="{{asset('img/front/blilgilm-logo.png')}}" alt="logo">
    </a>
</nav>

<!-- navbar navbar navbar-expand-sm sticky-top mb-5 -->
<nav class="navbar navbar navbar-expand-lg sticky-top mb-5">
    <section class="container">
        <button class="navbar-toggler ml-auto text-light order-3" data-toggle="collapse" data-target="#navigation">
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse order-4 order-md-2" id="navigation">
            <ul class="navbar-nav text-uppercase">
                <li class="nav-item">
                    <a href="/" class="nav-link active">home</a>
                </li>
                <li class="nav-item d-flex align-items-center">
                    <div class="d-flex">
                        <div class="dropdown mr-1">
                            <a href="#categories" class="nav-link" id="dropdownMenuOffset"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                               data-offset="10,20">categories <i class="fa fa-chevron-down"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuOffset">
                                @foreach($categories as $category)
                                    <a class="dropdown-item ml-0" href="{{ route('front.category', $category->name)}}">{{$category->name}}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="{{route('front.articles')}}" class="nav-link"> Articles</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('front.contact') }}" class="nav-link"> contact</a>
                </li>
            </ul>
            <form class="form-inline ml-auto" method='GET' action='{{ route('front.search') }}'>
                <input class="form-control " name='keyword' type="text" placeholder="Search" aria-label="Search" required>
                <button class = "fa fa-search" style="color:white" type='submit'></button>
            </form>
        </div>
    </section>
</nav>

<div id="front-page-wrapper" class="container">
    @yield('content')
</div>

<!-- footer -->
<footer>
    <section class="container">
        <div class="row mb-4">
            <section class="products col-sm col-md-3 col-lg-4 mb-5">
                <h4 class="text-uppercase mb-4">top products</h4>
                <ul class="pl-0">
                    @foreach($footerLinks as $link)
                        <li><a target="_blank" href="http://{{ $link->url }}" class="text-white">{{ $link->text }}</a></li>
                    @endforeach
                </ul>
            </section>
            <section class="email col-sm col-md-6 col-lg-4 mb-5">
                <h4 class="text-uppercase mb-4">newsletter</h4>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit ipsum dolor</p>
                <form class="form-inline">
                    <div class="form-group mb-0">
                        <input type="email" class="form-control mr-2" id="exampleInputEmail1"
                               aria-describedby="emailHelp" placeholder="Enter email">
                    </div>
                    <button type="button" class="btn btn-primary ml-2">Subscribe</button>
                </form>
            </section>
            <section class="insta offset-lg-1 col-sm col-md-3 col-lg-3">
                <h4 class="text-uppercase mb-4">instagram feed</h4>
                <figure>
                    <img src="{{ asset('img/front/instagram/i1.jpg') }}" class="mb-1">
                    <img src="{{ asset('img/front/instagram/i2.jpg') }}" class="mb-1">
                    <img src="{{ asset('img/front/instagram/i3.jpg') }}" class="mb-1">
                    <img src="{{ asset('img/front/instagram/i4.jpg') }}" class="mb-1">
                    <img src="{{ asset('img/front/instagram/i5.jpg') }}">
                    <img src="{{ asset('img/front/instagram/i6.jpg') }}">
                    <img src="{{ asset('img/front/instagram/i7.jpg') }}">
                    <img src="{{ asset('img/front/instagram/i8.jpg') }}">
                </figure>
            </section>
        </div>
    </section>
    <section class="last text-center">
        <p>Copyright &copy; All Right Reserved 2020
        </p>
    </section>

</footer>
<!-- end of footer -->

<!-- Mainly scripts -->
<script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
<script src="{{ asset('front_styles/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('front_styles/js/slick.js') }}"></script>

<script>
    $(".regular").slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        centerPadding: 0,
        centerMode: false,
        autoplay: true,
        autoplaySpeed: 2000,
        arrows: true,
        responsive: [
            {
                breakpoint: 980, // tablet breakpoint
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    centerMode: true,
                }
            },
            {
                breakpoint: 480, // mobile breakpoint
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    centerMode: true,
                }
            }
        ],
        prevArrow: "<img class='a-left control-c prev slick-prev' alt='' src='{{ asset('img/front/back-2.png') }}'>",
        nextArrow: "<img class='a-right control-c next slick-next' alt='' src='{{asset('img/front/next-2.png')}}'>"
    });
</script>

@stack('article-slider')

</body>
</html>
