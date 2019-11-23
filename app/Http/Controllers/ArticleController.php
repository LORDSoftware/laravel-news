<?php

namespace App\Http\Controllers;

use App\Article;

class ArticleController extends Controller
{
    public function show($slug)
    {
        $article = Article::with('comments')->where('slug', $slug)->firstOrFail();
        return view('article-show', compact('article'));
    }
}
