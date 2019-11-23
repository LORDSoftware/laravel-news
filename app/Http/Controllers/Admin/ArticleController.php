<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Article;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::with('category')->orderBy('created_at', 'desc')->get();
        return view('admin.article-index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::withDepth()->defaultOrder()->get();
        return view('admin.article-create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => ['required', 'max:255'],
            'description' => ['required'],
            'content' => ['required'],
            'slug' => ['required', 'alpha_dash', 'max:255', 'unique:articles'],
        ]);
        
        $article = new Article();
        $article->fill($request->all());
        $article->save();
        
        return redirect()->route('admin.articles.index')->with('messages', [__('messages.article_added')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::find($id);
        $categories = Category::withDepth()->defaultOrder()->get();
        
        return view('admin.article-edit', compact('article', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => ['required', 'max:255'],
            'description' => ['required'],
            'content' => ['required'],
            'slug' => ['required', 'alpha_dash', 'max:255', Rule::unique('articles')->ignore($id)],
        ]);
        
        $article = Article::find($id);
        $article->fill($request->all());
        $article->save();
        
        return redirect()->route('admin.articles.index')->with('messages', [__('messages.article_updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        $article->delete();
        
        return redirect()->route('admin.articles.index')->with('messages', [__('messages.article_deleted')]);
    }
}
