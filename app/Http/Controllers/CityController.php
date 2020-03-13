<?php
/**
 * CityController Class Doc Comment
 * PHP version 7.3
 * @category Class
 * @author   Abdullah Muhammed
 * @link    https://github.com/AbdullahMuhammed5/Auth-app
 *
 */
namespace App\Http\Controllers;

use App\City;
use App\Country;
use App\Http\Requests\CityRequest;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class CityController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(City::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     * @throws Exception
     */
    public function index(Request $request)
    {
        $columns = json_encode($this->getColumns());
        if ($request->ajax()) {
            $data = City::latest()->with('country');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', 'includes.ActionButtons')
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('dashboard.cities.index', compact('columns'));
    }

    public function getCities($id)
    {
        $cities= City::where("country_id", $id)->pluck("name", "id");
        return response()->json($cities);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        $countries = Country::pluck("name", "id");
        return view('dashboard.cities.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CityRequest $request
     * @return RedirectResponse
     */
    public function store(CityRequest $request)
    {
        City::create($request->all());
        return redirect()->route('cities.index')
            ->with('success', 'City created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param City $city
     * @return View
     */
    public function show(City $city)
    {
        return view('dashboard.cities.show', compact('city'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param City $city
     * @return View
     */
    public function edit(City $city)
    {
        $countries = Country::pluck("name", "id");
        return view('dashboard.cities.edit', compact('city', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CityRequest $request
     * @param City $city
     * @return RedirectResponse
     */
    public function update(CityRequest $request, City $city)
    {
        $city->update($request->all());
        return redirect()->route('cities.index')
            ->with('success', 'City Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param City $city
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(City $city)
    {
        $city->delete();
        return redirect()->route('cities.index')
            ->with('error', 'City Deleted successfully');
    }

    public function getColumns()
    {
        return [
            ['data' => 'id', 'name' => 'id'],
            ['data' => 'name', 'name' => 'name'],
            ['data' => 'country.name', 'name' => 'country_id'],
            ['data' => 'action', 'name' => 'action', 'orderable' => false, 'searchable' => false],
        ];
    }
}
