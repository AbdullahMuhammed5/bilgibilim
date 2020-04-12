<?php

namespace App\Http\Controllers\Home;

use App\HomeHeader;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class HomeHeadersController extends Controller
{
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
            $data = HomeHeader::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row){
                    return '<a href='.route("home-headers.edit", $row->id).' style="color: #1AB394"><i class="fa fa-edit fa-2x"></i></a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('dashboard.home-headers.index', compact('columns'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param HomeHeader $homeHeader
     * @return Factory|View
     */
    public function edit(HomeHeader $homeHeader)
    {
        return view('dashboard.home-headers.edit', compact('homeHeader'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param HomeHeader $homeHeader
     * @return RedirectResponse
     */
    public function update(Request $request, HomeHeader $homeHeader)
    {
        $homeHeader->update(['text'=>$request->input('text')]);
        return redirect()->route('home-headers.index')
            ->with('success', 'Updated successfully');
    }

    public function getColumns()
    {
        return [
            ['data' => 'id', 'name' => 'id'],
            ['data' => 'text', 'name' => 'text'],
            ['data' => 'action', 'name' => 'action', 'orderable' => false, 'searchable' => false],
        ];
    }
}

