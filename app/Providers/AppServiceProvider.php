<?php

namespace App\Providers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\ServiceProvider;
use App\Article;
use App\Category;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('includes.category-list', function(View $view){
            $categories = Category::with('children')->hasActiveArticles()->where('parent_id', null)->orderBy('created_at', 'asc')->get();
            $view->with('categories', $categories);
            
            //pass selected category ids
            $request = request();
            $selectedCategoryIDs = [];
            if($request->routeIs('categories.show')){
                $slug = $request->segment(count($request->segments()));
                $currentCategory = Category::where('slug', $slug)->first();
                
                $selectedCategoryIDs[] = $currentCategory->id;
                $selectedCategoryIDs = array_merge($selectedCategoryIDs, $currentCategory->ancestors->pluck('id')->all());
            } elseif ($request->routeIs('articles.show')){
                $slug = $request->segment(count($request->segments()));
                $currentArticle = Article::where('slug', $slug)->first();
                $currentCategory = $currentArticle->category;
                
                $selectedCategoryIDs[] = $currentCategory->id;
                $selectedCategoryIDs = array_merge($selectedCategoryIDs, $currentCategory->ancestors->pluck('id')->all());
            }
            $view->with('selectedCategoryIDs', $selectedCategoryIDs);
        });
    }
}
