<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;

class HomeController extends Controller
{

    /**
     * Show the application Home Page.
     *
     * @return Renderable
     */
    public function index()
    {
        return view('landing');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function dashboard()
    {
        return view('dashboard.index');
    }
}
