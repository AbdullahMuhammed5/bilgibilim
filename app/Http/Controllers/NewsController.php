<?php


namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\NewsRequest;
use App\News;
use App\Traits\UploadFile;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class NewsController extends Controller
{
    use UploadFile;

    public function __construct()
    {
        $this->authorizeResource(News::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Factory|View
     * @throws Exception
     */
    public function index(Request $request)
    {
        $columns = json_encode($this->getColumns());
        if ($request->ajax()) {
            $data = News::latest()->with('staff.user', 'category');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', 'dashboard.news.ActionButtons')
                ->addColumn('published', function($row){
                    return view('dashboard.news.toggleButton', compact('row'));
                })->addColumn('featured', function($row){
                    return view('dashboard.news.toggleFeatured', compact('row'));
                })
                ->rawColumns(['action', 'published'])
                ->make(true);
        }
        return view('dashboard.news.index', compact('columns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        $types = News::$types;
        $allCategories = Category::pluck('name', 'id')->all();
        return view('dashboard.news.create', compact('types', 'allCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param NewsRequest $request
     * @return RedirectResponse
     */
    public function store(NewsRequest $request)
    {
        $inserted = News::create($request->all());

        if ($request->file('cover')){
            $cover = $this->upload($request->file('cover'));
            $inserted->cover()->create(['path' => $cover]);
        }
        return redirect()->route('news.index')
            ->with('success', 'news created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param news $news
     * @return View
     */
    public function show(News $news)
    {
        return view('dashboard.news.show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param news $news
     * @return Factory|View
     */
    public function edit(News $news)
    {
        $allCategories = Category::pluck('name', 'id')->all();
        $authors = app('App\Http\Controllers\StaffController')->getAuthorsByJob($news->type);
        return view('dashboard.news.edit', compact('news', 'authors', 'allCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param NewsRequest $request
     * @param news $news
     * @return RedirectResponse
     */
    public function update(NewsRequest $request, News $news)
    {
        $news->update($request->all());
        if ($request->file('cover')){
            $cover = $this->upload($request->file('cover'));
            $news->cover()->update(['path' => $cover]);
        }
        return redirect()->route('news.index')
            ->with('success', 'news updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param News $news
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(News $news)
    {
        $news->delete();
        return redirect()->route('news.index')
            ->with('error', 'News deleted successfully');
    }

    // get columns for datatable.
    public function getColumns()
    {
        return [
            ['data' => 'id', 'name' => 'id'],
            ['data' => 'staff.user.first_name', 'name' => 'staff.user.first_name', 'defaultContent' => ""],
            ['data' => 'main_title', 'name' => 'main_title'],
            ['data' => 'secondary_title', 'name' => 'secondary_title'],
            ['data' => 'type', 'name' => 'type'],
            ['data' => 'category.name', 'name' => 'category.name', 'filter_index'=> 'category_id'],
            ['data' => 'views', 'name' => 'views'],
            ['data' => 'published', 'name' => 'published'],
            ['data' => 'featured', 'name' => 'featured'],
            ['data' => 'action', 'name' => 'action', 'orderable' => false, 'searchable' => false]
        ];
    }

    // toggle news publishing
    public function togglePublishing(News $news){
        $news->update(['published' => !$news->published ]);
    }

    // make feature news
    public function toggleFeatured(News $news){
        $news->update(['is_featured' => !$news->is_featured ]);
    }

}
