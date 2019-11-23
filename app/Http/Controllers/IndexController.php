<?php

namespace App\Http\Controllers;

use App\Article;

class IndexController extends Controller
{
    public function index()
    {
        $orderField = request('order_field', 'created_at');
        $orderDirection = request('order_direction', 'desc');
        
        $articles = Article::active()->orderBy($orderField, $orderDirection)->paginate(3);
        $articlesOrderData = ['order_field' => $orderField, 'order_direction' => $orderDirection];
        
        return view('index', compact('articles', 'articlesOrderData'));
    }
}
