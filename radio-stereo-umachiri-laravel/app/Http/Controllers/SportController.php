<?php

namespace App\Http\Controllers;

use App\Models\Sport;
use Illuminate\Http\Request;

class SportController extends Controller
{
    public function index()
    {
        $sports = Sport::latest()->paginate(10);
        return view('sports.index', compact('sports'));
    }

    public function show($id)
    {
        $sport = Sport::findOrFail($id);
        $relatedSports = Sport::where('id', '!=', $sport->id)->inRandomOrder()->limit(5)->get();

        return view('sports.show', compact('sport', 'relatedSports'));
    }
}
