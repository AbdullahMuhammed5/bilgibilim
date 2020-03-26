<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\ContactRequest;
use App\News;
use Carbon\Carbon;
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
        $sliderNews = News::with('images')
            ->whereDate('created_at', Carbon::today())
            ->limit(3)->get()->toArray();
        $mostViews = News::with('images')->orderBy('views', 'desc')->limit(10)->get();
        $categoriesSection = [
            'Politics'   => News::where('category_id', Category::POLITICS)->limit(2)->get(),
            'Technology' => News::where('category_id', Category::TECHNOLOGY)->limit(2)->get(),
            'Sports'     => News::where('category_id', Category::SPORTS)->limit(2)->get(),
            'Science'    => News::where('category_id', Category::SCIENCE)->limit(2)->get(),
        ];
        $worldNews = News::where('category_id', Category::WORLD)->with('images')->limit(4)->get()->toArray();
        return view('front.home', compact(
            'sliderNews', 'mostViews', 'categoriesSection', 'worldNews'));
    }

    /**
     * Show Article.
     *
     * @param News $news
     * @return Renderable
     */
    public function article(News $news)
    {
        $news->update(['views', $news->views++]);
        $relatedNews = News::where('category_id', $news->category_id)->limit(3)->get();
        return view('front.articles.show', compact('news', 'relatedNews'));
    }

    /**
     * Show Articles page.
     *
     * @return Renderable
     */
    public function articles()
    {
        $allNews = News::whereType('Article')->paginate(5);
        return view('front.articles.index', compact('allNews'));
    }

    /**
     * Show Contact Page.
     *
     * @return Renderable
     */
    public function contact()
    {
        return view('front.contact.index');
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

    /**
     * Contact page submit.
     *
     * @param ContactRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function sendContact(ContactRequest $request)
    {
        \DB::table('contact')->insert([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'message' => $request->input('message'),
        ]);

        return redirect()->route('front.contact');
    }
}
