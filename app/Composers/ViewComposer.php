<?php

namespace App\Composers;

use App\Category;
use App\FooterLink;
use App\News;
use Illuminate\View\View;

class ViewComposer
{
    protected $allCategories;
    protected $sideSectionNews;
    protected $footerLinks;

    /**
     * Create a new ViewComposer instance.
     */
    public function __construct()
    {
        $this->allCategories = Category::all();
        $this->footerLinks = FooterLink::all();
        $this->sideSectionNews = News::published()->with('cover')->limit(5)->get()->toArray();
    }

    /**
     * Compose the view.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('categories', $this->allCategories);
        $view->with('sideSectionNews', $this->sideSectionNews);
        $view->with('footerLinks', $this->footerLinks);
    }
}
