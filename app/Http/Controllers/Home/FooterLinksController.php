<?php

namespace App\Http\Controllers\Home;

use App\FooterLink;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse as RedirectResponseAlias;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class FooterLinksController extends Controller
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
            $data = FooterLink::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row){
                    return '<a href='.route("footer-links.edit", $row->id).' style="color: #1AB394"><i class="fa fa-edit fa-2x"></i></a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('dashboard.footer-links.index', compact('columns'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param FooterLink $footerLink
     * @return Factory|View
     */
    public function edit(FooterLink $footerLink)
    {
        return view('dashboard.footer-links.edit', compact('footerLink'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param FooterLink $footerLink
     * @return RedirectResponseAlias
     */
    public function update(Request $request, FooterLink $footerLink)
    {
        $footerLink->update([
            'text'=>$request->input('text'),
            'url' => $request->input('url')
        ]);
        return redirect()->route('footer-links.index')
            ->with('success', 'Updated successfully');
    }
    public function getColumns()
    {
        return [
            ['data' => 'id', 'name' => 'id'],
            ['data' => 'text', 'name' => 'text'],
            ['data' => 'url', 'name' => 'url'],
            ['data' => 'action', 'name' => 'action', 'orderable' => false, 'searchable' => false],
        ];
    }
}
