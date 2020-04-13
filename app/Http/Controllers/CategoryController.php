<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CategoryRequest;
use App\News;
use App\Traits\UploadFile;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    use UploadFile;

    public function __construct()
    {
        $this->authorizeResource(Category::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Factory|View
     * @throws \Exception
     */
    public function index(Request $request)
    {
        $columns = json_encode($this->getColumns());
        if ($request->ajax()) {
            $data = Category::latest();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', 'dashboard.categories.ActionButtons')
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('dashboard.categories.index', compact('columns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('dashboard.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     * @return RedirectResponse
     */
    public function store(CategoryRequest $request)
    {
        $inserted = Category::create($request->all());
        if ($request->file('cover')){
            $cover = $this->upload($request->file('cover'));
            $inserted->cover()->create(['path' => $cover]);
        }
        return redirect()->route('categories.index')
            ->with('success', 'Category created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return Factory|View
     */
    public function edit(Category $category)
    {
        return view('dashboard.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryRequest $request
     * @param Category $category
     * @return RedirectResponse
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->all());
        if ($request->file('cover')){
            $cover = $this->upload($request->file('cover'));
            $category->cover()->updateOrCreate(['path' => $cover]);
        }
        return redirect()->route('categories.index')
            ->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')
            ->with('error', 'Category deleted successfully');
    }

    /**
     * Display a listing of the resource.
     *
     * @param $name
     * @return View
     */
    public function getByCategory($name)
    {
        $category = Category::whereName($name)->with('news')->get()->first();
        $allNews = $category->news()->paginate(5);
        $otherCategories = Category::with('cover')
            ->whereNotIn('id', [$category->id])
            ->limit(4)->get();
        return view('front.categories.view', compact('allNews', 'otherCategories'));
    }

    public function getColumns()
    {
        return [
            ['data' => 'id', 'name' => 'id'],
            ['data'=> 'name', 'name'=> 'name'],
            ['data'=> 'description', 'name'=> 'description'],
            ['data'=> 'action', 'name'=> 'action', 'orderable'=> false, 'searchable'=> false],
        ];
    }
}
