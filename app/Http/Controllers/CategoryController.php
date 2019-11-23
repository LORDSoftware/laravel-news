<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;

class CategoryController extends Controller
{
    public function show($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        
        $orderField = request('order_field', 'created_at');
        $orderDirection = request('order_direction', 'desc');
        
        $articles = Article::active()->ofCategory($category)->orderBy($orderField, $orderDirection)->paginate(3);
        $articlesOrderData = ['order_field' => $orderField, 'order_direction' => $orderDirection];
        
        return view('category-show', compact('category', 'articles', 'articlesOrderData'));
    }
}
