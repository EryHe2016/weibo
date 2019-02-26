<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticPagesController extends Controller
{
    public function home()
    {
    	return view('staticPages.home');
    }

    public function help()
    {
    	return view('staticPages.help');
    }

    public function about()
    {
    	return view('staticPages.about');
    }
}
