<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $news = DB::table('news')->get();
        $recoms = Recom::get();
        return view('index',compact('news','recoms'));
    }
    public function admin(){
        return view('admin/index');
    }

    public function welcome()
    {
        if (Auth::user()) {
            return redirect()->route('home');
        }
        return view('welcome');
    }
}
