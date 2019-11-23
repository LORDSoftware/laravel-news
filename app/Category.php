<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model
{
    use NodeTrait;
    
    protected $table = 'categories';
    protected $fillable = ['title', 'slug', 'parent_id'];
    
    public function childrenWithActiveArticles(){
        return $this->hasMany(self::class, 'parent_id', 'id')->hasActiveArticles();
    }
    
    public function articles(){
        return $this->hasMany(Article::class, 'category_id', 'id');
    }

    public function scopeHasActiveArticles($query){
        return $query->has('descendants.articles', '>', 0)->orHas('articles', '>', 0);
    }
    
}
