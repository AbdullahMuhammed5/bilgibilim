<?php

namespace App\Composers;

use App\Category;
use App\News;
use Illuminate\View\View;

class ViewComposer
{
    protected $allCategories;
    protected $sideSectionNews;

    /**
     * Create a new ViewComposer instance.
     */
    public function __construct()
    {
        $this->allCategories = Category::all();
        $this->sideSectionNews = News::featured()->with('cover')->limit(2)->get()->toArray();
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
    }
}
