<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function show($slug)
    {
        $article = Article::with(['comments' => function ($query) {
            $query->whereNull('parent_id')->with('replies')->latest();
        }])->where('slug', $slug)->firstOrFail();


        $relatedArticles = Article::where('category_id', $article->category_id)
                                  ->where('slug', '!=', $article->slug)
                                  ->limit(3)
                                  ->get();

        return view('articles.show', compact('article', 'relatedArticles'));
    }
}