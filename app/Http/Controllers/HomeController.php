<?php

namespace App\Http\Controllers;

use App\Category;
use App\FooterLink;
use App\HomeHeader;
use App\Http\Requests\ContactRequest;
use App\News;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Show the application Home Page.
     *
     * @return Renderable
     */
    public function front()
    {
        $sliderNews = News::published()->with( 'cover')
            ->whereDate('created_at', Carbon::today())
            ->latest()
            ->limit(3)->get()->toArray();

        $mostViews = News::with('cover')
            ->orderBy('views', 'desc')
            ->limit(10)->get();

        $categoriesSection = [
            'Politics'   => News::published()->where('category_id', Category::POLITICS)->limit(2)->get(),
            'Technology' => News::published()->where('category_id', Category::TECHNOLOGY)->limit(2)->get(),
            'Sports'     => News::published()->where('category_id', Category::SPORTS)->limit(2)->get(),
            'Science'    => News::published()->where('category_id', Category::SCIENCE)->limit(2)->get(),
        ];

        $sectionHeadersAll = HomeHeader::all();

        $sectionHeaders = [
            'today' => $sectionHeadersAll[0]->text,
            'most_read' => $sectionHeadersAll[1]->text,
            'categories' => $sectionHeadersAll[2]->text,
            'world' => $sectionHeadersAll[3]->text,
        ];

        $worldNews = News::published()
            ->where('category_id', Category::WORLD)
            ->with('cover')
            ->limit(4)->get()->toArray();

        return view('front.home', compact(
            'sliderNews', 'mostViews', 'categoriesSection', 'worldNews', 'sectionHeaders'));
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
        $relatedNews = News::published()
            ->where('category_id', $news->category_id) // Same category
            ->Where('id', '<>', $news->id) // Not same article
            ->latest()->limit(3)->get();
        return view('front.articles.show', compact('news', 'relatedNews'));
    }

    /**
     * Show Articles page.
     *
     * @return Renderable
     */
    public function articles()
    {
        $allNews = News::published()->whereType('Article')->paginate(5);
        return view('front.articles.index', compact('allNews'));
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
     * Search page.
     *
     * @param Request $request
     * @return Factory|View
     */
    public function search(Request $request)
    {
        $term = trim($request['keyword']);

        $result = News::published()
                ->where('main_title', 'like', "%$term%")
                ->orWhere('secondary_title', 'like', "%$term%")
                ->orWhere('content', 'like', "%$term%")
                ->paginate(5);

        return view('front.search.index', compact('result'));
    }
}
