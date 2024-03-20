<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function change_locale($locale)
    {
        $language=Language::where('iso',$locale)->first();

        session()->put('locale',$locale);
        session()->put('rtl',$language['rtl']);
        session()->forget('trans');

        return redirect()->back();
    }
}
