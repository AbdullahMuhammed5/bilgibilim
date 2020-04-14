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
        $sliderNews = News::published()
            ->with( 'cover')
            ->latest()
            ->limit(3)->get()->toArray();

        $mostViews = News::published()
            ->with('cover')
            ->orderBy('views', 'desc')
            ->limit(10)->get();

        $categoriesSection = Category::with(['news', 'cover'])->limit(4)->get()
            ->map(function($category){
                $category->setRelation('news', $category->news->take(2));
                return $category;
            });

        $sectionHeadersAll = HomeHeader::all();

        $sectionHeaders = [
            'today' => $sectionHeadersAll[0]->text,
            'most_read' => $sectionHeadersAll[1]->text,
            'categories' => $sectionHeadersAll[2]->text,
            'world' => $sectionHeadersAll[3]->text,
        ];

        $worldNews = News::published()
            ->with('cover')
            ->where('category_id', Category::WORLD)
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
