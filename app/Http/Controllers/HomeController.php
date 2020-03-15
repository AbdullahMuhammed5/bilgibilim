<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Contracts\Support\Renderable;

class HomeController extends Controller
{

    /**
     * Show the application Home Page.
     *
     * @return Renderable
     */
    public function front()
    {
        $featuredNews = News::featured()->with('images')->get()->toArray();
//        dd(News::featured()->get()[0]);
        $carouselIndexes = ['one', 'two', 'three', 'four']; // class names for carousel slider
        for ($i = 0; $i < count($featuredNews); $i++ )
            $featuredNews[$i]['carouselIndex'] = $carouselIndexes[$i];
//        dd($featuredNews[0]);
        return view('front.home', compact('featuredNews'));
    }

    /**
     * Show Article.
     *
     * @param News $news
     * @return Renderable
     */
    public function article(News $news)
    {
        return view('front.article.show', compact('news'));
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function dashboard()
    {
        if (auth()->user()){
            return view('dashboard.index');
        }else{
            return view('auth.login');
        }
    }
}
