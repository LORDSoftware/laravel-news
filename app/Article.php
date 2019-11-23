<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['title', 'description', 'content', 'slug', 'category_id', 'active'];
    
    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }
    
    public function comments(){
        return $this->hasMany(Comment::class, 'article_id');
    }
    
    /**
     * Scope a query to only include active articles.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query){
        return $query->where('active', '=', '1');
    }
    
    /**
     * Scope a query to only include articles of current category and its descendants.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param Category $category
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfCategory($query, $category){
        $categories = $category->descendants;
        $categories->add($category);

        return $query->whereIn('category_id', $categories->pluck('id')->all());
    }
}
