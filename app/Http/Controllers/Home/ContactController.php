<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactController extends Controller
{
    /**
     * Show Contact Page.
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('front.contact.index');
    }

    /**
     * Contact page submit.
     *
     * @param ContactRequest $request
     * @return RedirectResponse
     */
    public function sendContact(ContactRequest $request)
    {
        \DB::table('contact')->insert([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'message' => $request->input('message'),
        ]);

        return redirect()->route('front.contact');
    }
}
