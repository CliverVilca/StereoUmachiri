<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Vista pública de detalle de noticia
     */
    public function detalle($id)
    {
        $news = \App\Models\News::findOrFail($id);
        // Algoritmo mejorado de noticias relacionadas por similitud de palabras clave
        $keywords = collect(explode(' ', preg_replace('/[^\w\s]/u', '', $news->title)))->filter(function($word) {
            return mb_strlen($word) > 3;
        })->take(5)->toArray();
        $relatedQuery = \App\Models\News::where('id', '!=', $news->id);
        $relatedQuery->where(function($query) use ($keywords, $news) {
            foreach ($keywords as $kw) {
                $query->orWhere('title', 'like', "%$kw%")
                      ->orWhere('content', 'like', "%$kw%");
            }
        });
        $relatedNews = $relatedQuery->orderBy('published_at', 'desc')->limit(4)->get();
        return view('noticias.detalle', compact('news', 'relatedNews'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = \App\Models\News::orderBy('published_at', 'desc')->paginate(10);
        return view('admin.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'author' => 'required|string|max:255',
            'published_at' => 'required|date',
            'type' => 'required|in:local,internacional',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('assets/images/news', 'public');
        }

        \App\Models\News::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'author' => $validated['author'],
            'published_at' => $validated['published_at'],
            'type' => $validated['type'],
            'image' => $imagePath,
        ]);

        return redirect()->route('news.index')->with('success', 'Noticia creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $news = \App\Models\News::findOrFail($id);
        return view('admin.news.show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $news = \App\Models\News::findOrFail($id);
        return view('admin.news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $news = \App\Models\News::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'author' => 'required|string|max:255',
            'published_at' => 'required|date',
            'type' => 'required|in:local,internacional',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('assets/images/news', 'public');
            $news->image = $imagePath;
        }

        $news->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'author' => $validated['author'],
            'published_at' => $validated['published_at'],
            'type' => $validated['type'],
        ]);

        $news->save();
        return redirect()->route('news.index')->with('success', 'Noticia actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $news = \App\Models\News::findOrFail($id);
        if ($news->image) {
            \Storage::disk('public')->delete($news->image);
        }
        $news->delete();
        return redirect()->route('news.index')->with('success', 'Noticia eliminada correctamente.');
    }
}
