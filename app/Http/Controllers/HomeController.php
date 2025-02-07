<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(Request $request)
    {
        // Ambil semua kategori
        $categories = Category::all();

        // Ambil artikel berdasarkan kategori dan pencarian
        $articlesQuery = Article::with('category');

        // Filter pencarian
        if ($request->has('query') && $request->input('query') != '') {
            $articlesQuery = $articlesQuery->where(function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->input('query') . '%')
                      ->orWhere('content', 'like', '%' . $request->input('query') . '%');
            });
        }

        // Filter kategori
        if ($request->has('category') && $request->input('category') != '') {
            $articlesQuery = $articlesQuery->where('category_id', $request->input('category'));
        }

        // Ambil artikel yang di-highlight untuk hero section
        $highlightedArticles = Article::where('is_highlighted', true)
            ->latest()
            ->take(5)
            ->get();

        // Ambil artikel biasa (paginated)
        $articles = $articlesQuery->latest()->paginate(6);

        // Return view dengan data
        return view('articles.index', compact('articles', 'categories', 'highlightedArticles'));
    }

    // Show individual article
    public function show($slug)
    {
        // Ambil artikel berdasarkan slug
        $article = Article::with('category')->where('slug', $slug)->firstOrFail();

        // Ambil artikel terkait berdasarkan kategori
        $relatedArticles = Article::where('category_id', $article->category_id)
            ->where('id', '!=', $article->id)
            ->latest()
            ->take(5)
            ->get();

        // Return view untuk artikel
        return view('articles.show', compact('article', 'relatedArticles'));
    }
}