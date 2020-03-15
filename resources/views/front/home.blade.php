@extends('layouts.front')

@section('content')
<div class="container" id="home-page">

    <div id="inSlider" class="carousel carousel-fade" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#inSlider" data-slide-to="0" class="active"></li>
            <li data-target="#inSlider" data-slide-to="1"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            @foreach($featuredNews as $key=>$news)
            <div class="item @if($news['carouselIndex'] == 'one') active @endif">
                <div class="container">
                    <div class="carousel-caption">
                        <h1>{{$news['main_title']}}</h1>
                        <p>{{ substr(strip_tags($news['content']), 0, 150).'...' }}</p>
                        <p>
                            <a class="btn btn-lg btn-primary" href="{{ route('front.article', $news['id']) }}" role="button">READ MORE</a>
                        </p>
                    </div>
                </div>
                <!-- Set background for slide in css -->
                <div class="header-back {{$news['carouselIndex']}}"
                     style="background-image: url('{{Storage::url($news['images'][0]['path'])}}')"></div>
            </div>
            @endforeach
{{--            <div class="item">--}}
{{--                <div class="container">--}}
{{--                    <div class="carousel-caption blank">--}}
{{--                        <h1>We create meaningful <br/> interfaces that inspire.</h1>--}}
{{--                        <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam.</p>--}}
{{--                        <p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <!-- Set background for slide in css -->--}}
{{--                <div class="header-back two"></div>--}}
{{--            </div>--}}
        </div>
        <a class="left carousel-control" href="#inSlider" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#inSlider" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <section id="latest">
        <header>
            <h2 class="font-bold">LATEST</h2>
            <hr class="hr-line-solid m-b-lg" style="max-width: 200px; margin-left: 0;">

        </header>
        <div class="row p-h-md">
            <div class="col-lg-4">
                <div class="ibox">
                    <div class="ibox-content">
                        <a href="article.html" class="btn-link">
                            <h2>
                                One morning, when Gregor Samsa
                            </h2>
                        </a>
                        <div class="small m-b-xs">
                            <strong>Adam Novak</strong> <span class="text-muted"><i class="fa fa-clock-o"></i> 28th Oct 2015</span>
                        </div>
                        <p>
                            English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web
                        </p>
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Tags:</h5>
                                <button class="btn btn-primary btn-xs" type="button">Model</button>
                                <button class="btn btn-white btn-xs" type="button">Publishing</button>
                            </div>
                            <div class="col-md-6">
                                <div class="small text-right">
                                    <h5>Stats:</h5>
                                    <div> <i class="fa fa-comments-o"> </i> 56 comments </div>
                                    <i class="fa fa-eye"> </i> 144 views
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ibox">
                    <div class="ibox-content">
                        <a href="article.html" class="btn-link">
                            <h2>
                                It showed a lady fitted out with
                            </h2>
                        </a>
                        <div class="small m-b-xs">
                            <strong>Mike Smith</strong> <span class="text-muted"><i class="fa fa-clock-o"></i> 11th May 2015</span>
                        </div>
                        <p>
                            The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of.
                        </p>
                        <p>
                            No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences
                        </p>
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Tags:</h5>
                                <button class="btn btn-primary btn-xs" type="button">New</button>
                                <button class="btn btn-white btn-xs" type="button">Model</button>
                                <button class="btn btn-white btn-xs" type="button">Publishing</button>
                            </div>
                            <div class="col-md-6">
                                <div class="small text-right">
                                    <h5>Stats:</h5>
                                    <div> <i class="fa fa-comments-o"> </i> 36 comments </div>
                                    <i class="fa fa-eye"> </i> 100 views
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ibox">
                    <div class="ibox-content">
                        <a href="article.html" class="btn-link">
                            <h2>
                                The bedding was hardly able to cover
                            </h2>
                        </a>
                        <div class="small m-b-xs">
                            <strong>Anthony Dvorak</strong> <span class="text-muted"><i class="fa fa-clock-o"></i> 11th Dec 2014</span>
                        </div>
                        <p>
                            A collection of textile samples lay spread out on the table - Samsa was a travelling salesman.
                        </p>
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Tags:</h5>
                                <button class="btn btn-white btn-xs" type="button">Publishing</button>
                            </div>
                            <div class="col-md-6">
                                <div class="small text-right">
                                    <h5>Stats:</h5>
                                    <div> <i class="fa fa-comments-o"> </i> 11 comments </div>
                                    <i class="fa fa-eye"> </i> 46 views
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="ibox">
                    <div class="ibox-content">
                        <a href="article.html" class="btn-link">
                            <h2>
                                Junk MTV quiz graced by fox whelps.
                            </h2>
                        </a>
                        <div class="small m-b-xs">
                            <strong>alex Trebek</strong> <span class="text-muted"><i class="fa fa-clock-o"></i> 07 Apr 2015</span>
                        </div>
                        <p>
                            Alex Trebek's fun TV quiz game. Woven silk pyjamas exchanged for blue quartz. Brawny gods just zebra, and my wolves quack! Blowzy red vixens fight for a quick.
                        </p>
                        <p>
                            On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the.
                        </p>
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Tags:</h5>
                                <button class="btn btn-white btn-xs" type="button">Model</button>
                                <button class="btn btn-white btn-xs" type="button">Publishing</button>
                                <button class="btn btn-white btn-xs" type="button">Modern</button>
                                <button class="btn btn-white btn-xs" type="button">Premium</button>
                            </div>
                            <div class="col-md-6">
                                <div class="small text-right">
                                    <h5>Stats:</h5>
                                    <div> <i class="fa fa-comments-o"> </i> 23 comments </div>
                                    <i class="fa fa-eye"> </i> 34 views
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ibox">
                    <div class="ibox-content">
                        <a href="article.html" class="btn-link">
                            <h2>
                                Two driven jocks help fax my big
                            </h2>
                        </a>
                        <div class="small m-b-xs">
                            <strong>Monica Jackson</strong> <span class="text-muted"><i class="fa fa-clock-o"></i> 14th Oct 2015</span>
                        </div>
                        <p>
                            Flummoxed by job, kvetching W. zaps Iraq. Cozy sphinx waves quart jug of bad milk. A very bad quack might jinx zippy fowls. Few quips galvanized
                        </p>
                        <p>
                            It wasn't a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls.
                        </p>
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Tags:</h5>
                                <button class="btn btn-white btn-xs" type="button">Modern</button>
                                <button class="btn btn-white btn-xs" type="button">Model</button>
                            </div>
                            <div class="col-md-6">
                                <div class="small text-right">
                                    <h5>Stats:</h5>
                                    <div> <i class="fa fa-comments-o"> </i> 32 comments </div>
                                    <i class="fa fa-eye"> </i> 10 views
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ibox">
                    <div class="ibox-content">
                        <a href="article.html" class="btn-link">
                            <h2>
                                I feel the presence of the Almighty
                            </h2>
                        </a>
                        <div class="small m-b-xs">
                            <strong>John Smith</strong> <span class="text-muted"><i class="fa fa-clock-o"></i> 04 Dec 2015</span>
                        </div>
                        <p>
                            I hear the buzz of the little world among the stalks, and grow familiar with the countless indescribable forms of the insects and flies, then I feel the presence of the Almighty, who formed us in his own image, and the breath
                            Gregor then turned to look out the window at the dull weather.
                        </p>
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Tags:</h5>
                                <button class="btn btn-white btn-xs" type="button">Publishing</button>
                                <button class="btn btn-white btn-xs" type="button">Premium</button>

                            </div>
                            <div class="col-md-6">
                                <div class="small text-right">
                                    <h5>Stats:</h5>
                                    <div> <i class="fa fa-comments-o"> </i> 22 comments </div>
                                    <i class="fa fa-eye"> </i> 17 views
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="ibox">
                    <div class="ibox-content">
                        <a href="article.html" class="btn-link">
                            <h2>
                                The European languages are members
                            </h2>
                        </a>
                        <div class="small m-b-xs">
                            <strong>Anthony Pits</strong> <span class="text-muted"><i class="fa fa-clock-o"></i> 04 Jan 2015</span>
                        </div>
                        <p>
                            The languages only differ in their grammar, their pronunciation and their most common words. Everyone realizes why a new common language would be desirable: one could refuse to pay expensive translators.
                        </p>
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Tags:</h5>
                                <button class="btn btn-primary btn-xs" type="button">Publishing</button>
                                <button class="btn btn-white btn-xs" type="button">Model</button>
                            </div>
                            <div class="col-md-6">
                                <div class="small text-right">
                                    <h5>Stats:</h5>
                                    <div> <i class="fa fa-comments-o"> </i> 54 comments </div>
                                    <i class="fa fa-eye"> </i> 52 views
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ibox">
                    <div class="ibox-content">
                        <a href="article.html" class="btn-link">
                            <h2>
                                The new common language
                            </h2>
                        </a>
                        <div class="small m-b-xs">
                            <strong>Adam Novak</strong> <span class="text-muted"><i class="fa fa-clock-o"></i> 14th Oct 2015</span>
                        </div>
                        <p>
                            English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web
                        </p>
                        <p>
                            The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he
                        </p>
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Tags:</h5>
                                <button class="btn btn-white btn-xs" type="button">Publishing</button>
                                <button class="btn btn-white btn-xs" type="button">Model</button>
                                <button class="btn btn-white btn-xs" type="button">Premium</button>
                            </div>
                            <div class="col-md-6">
                                <div class="small text-right">
                                    <h5>Stats:</h5>
                                    <div> <i class="fa fa-comments-o"> </i> 47 comments </div>
                                    <i class="fa fa-eye"> </i> 138 views
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ibox">
                    <div class="ibox-content">
                        <a href="article.html" class="btn-link">
                            <h2>
                                Their pronunciation and their most
                            </h2>
                        </a>
                        <div class="small m-b-xs">
                            <strong>Mike Johnson</strong> <span class="text-muted"><i class="fa fa-clock-o"></i> 11th Oct 2015</span>
                        </div>
                        <p>
                            To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses
                        </p>
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Tags:</h5>
                                <button class="btn btn-primary btn-xs" type="button">Publishing</button>
                                <button class="btn btn-white btn-xs" type="button">Model</button>
                            </div>
                            <div class="col-md-6">
                                <div class="small text-right">
                                    <h5>Stats:</h5>
                                    <div> <i class="fa fa-comments-o"> </i> 54 comments </div>
                                    <i class="fa fa-eye"> </i> 52 views
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <section id="categories">
        <header>
            <h2 class="font-bold">CATEGORIES</h2>
            <hr class="hr-line-solid m-b-lg" style="max-width: 200px; margin-left: 0;">
        </header>
        <section>
            <article><img src="https://via.placeholder.com/200" alt="">
                <h3>Lorem ipsum.</h3>
                <a href="" class="btn btn-primary">View all</a></article>
            <article><img src="https://via.placeholder.com/200" alt="">
                <h3>Lorem ipsum.</h3>
                <a href="" class="btn btn-primary">View all</a></article>
            <article><img src="https://via.placeholder.com/200" alt="">
                <h3>Lorem ipsum.</h3>
                <a href="" class="btn btn-primary">View all</a></article>
            <article><img src="https://via.placeholder.com/200" alt="">
                <h3>Lorem ipsum.</h3>
                <a href="" class="btn btn-primary">View all</a></article>
        </section>
    </section>

    <section id="most-viewed">
        <header>
            <h2 class="font-bold">MOST VIEWED</h2>
            <hr class="hr-line-solid m-b-lg" style="max-width: 200px; margin-left: 0;">
        </header>
        <section>
            <article class="left-side article m-r-sm" style="background-image: url({{ 'https://via.placeholder.com/400' }})">
                <span>padge</span>
                <h2>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eum labore quos repudiandae!</h2>
                <span>author name</span>
                <span>published date</span>
            </article>
            <article class="right-side">
                <article class="article m-b-sm" style="background-image: url({{ 'https://via.placeholder.com/400' }})">
                    <span>padge</span>
                    <h2>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eum labore quos repudiandae!</h2>
                    <span>author name</span>
                    <span>published date</span>
                </article>
                <article class="bottom">
                    <article class="article m-r-sm" style="background-image: url({{ 'https://via.placeholder.com/400' }})">
                        <span>padge</span>
                        <h2>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eum labore quos repudiandae!</h2>
                        <span>author name</span>
                        <span>published date</span>
                    </article>
                    <article class="article" style="background-image: url({{ 'https://via.placeholder.com/400' }})">
                        <span>padge</span>
                        <h2>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eum labore quos repudiandae!</h2>
                        <span>author name</span>
                        <span>published date</span>
                    </article>
                </article>
            </article>
        </section>
    </section>

</div>

<section id="contact" class="gray-section contact">
    <div class="container">
        <div class="row m-b-lg">
            <div class="col-lg-12 text-center">
                <div class="navy-line"></div>
                <h1>Contact Us</h1>
                <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod.</p>
            </div>
        </div>
        <div class="row m-b-lg">
            <div class="col-lg-3 col-lg-offset-3">
                <address>
                    <strong><span class="navy">Company name, Inc.</span></strong><br/>
                    795 Folsom Ave, Suite 600<br/>
                    San Francisco, CA 94107<br/>
                    <abbr title="Phone">P:</abbr> (123) 456-7890
                </address>
            </div>
            <div class="col-lg-4">
                <p class="text-color">
                    Consectetur adipisicing elit. Aut eaque, totam corporis laboriosam veritatis quis ad perspiciatis, totam corporis laboriosam veritatis, consectetur adipisicing elit quos non quis ad perspiciatis, totam corporis ea,
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center">
                <a href="mailto:test@email.com" class="btn btn-primary">Send us mail</a>
                <p class="m-t-sm">
                    Or follow us on social platform
                </p>
                <ul class="list-inline social-icon">
                    <li><a href="#"><i class="fa fa-twitter"></i></a>
                    </li>
                    <li><a href="#"><i class="fa fa-facebook"></i></a>
                    </li>
                    <li><a href="#"><i class="fa fa-linkedin"></i></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 text-center m-t-lg m-b-lg">
                <p><strong>&copy; 2015 Company Name</strong><br/> consectetur adipisicing elit. Aut eaque, laboriosam veritatis, quos non quis ad perspiciatis, totam corporis ea, alias ut unde.</p>
            </div>
        </div>
    </div>
</section>
@stop
