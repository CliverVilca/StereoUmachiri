<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Dj;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // app/Http\Controllers\HomeController.php
public function index()
{
    $recentNews = News::where('status', 'published') // ✅ FILTRAR POR PUBLICADAS
                      ->where('published_at', '<=', now()) // ✅ SOLO NOTICIAS CON FECHA PASADA
                      ->orderBy('published_at', 'desc')
                      ->take(3)
                      ->get();

    return view('home', compact('recentNews'));
}
}
