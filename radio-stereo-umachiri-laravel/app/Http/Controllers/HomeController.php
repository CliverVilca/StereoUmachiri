<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $localNews = \App\Models\News::where('type', 'local')->orderBy('published_at', 'desc')->take(3)->get();
        $internationalNews = \App\Models\News::where('type', 'internacional')->orderBy('published_at', 'desc')->take(3)->get();
        return view('home', compact('localNews', 'internationalNews'));
        return view('home', compact('latestNews'));
    }
} 