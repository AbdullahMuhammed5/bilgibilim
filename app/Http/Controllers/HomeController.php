<?php

namespace App\Http\Controllers;

use App\Category;
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
        $sectionOne = News::featured()->with('images')->limit(5)->get()->toArray();
        $sliderNews = array_slice($sectionOne, 0, 3);
        $sideBarNews = array_slice($sectionOne, 2, 2);
        $allArticles = News::whereType('Article')->with('images')->get();
        $categories = Category::all();
        $categoriesSection = [
            'Politics' => News::where('category_id', Category::POLITICS)->limit(2)->get(),
            'Technology' => News::where('category_id', Category::TECHNOLOGY)->limit(2)->get(),
            'Sports' => News::where('category_id', Category::SPORTS)->limit(2)->get(),
            'Science' => News::where('category_id', Category::SCIENCE)->limit(2)->get(),
        ];
        $worldNews = News::where('category_id', Category::WORLD)->with('images')->limit(4)->get()->toArray();
        return view('front.home', compact(
            'sliderNews', 'sideBarNews', 'categories', 'allArticles', 'categoriesSection', 'worldNews'));
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
