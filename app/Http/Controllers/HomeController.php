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
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $time = "03:00:00"; //implement this shit
        $tops = [1=>"1st", 2=>"2nd", 3=>"3rd", 4=>"4th", 5=>"5th", 6=>"6th", 7=>"7th", 8=>"8th", 9=>"9th", 10=>"10th"]; //implement later
        return view('home')->with(compact('time', 'tops'));
    }
}
