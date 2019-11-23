<?php

use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Category::class, 3)->create()->each(function($category1) {
            factory(App\Category::class, 3)->create(['parent_id' => $category1->id])->each(function($category2) {
                factory(App\Article::class, 3)->create(['category_id' => $category2->id])->each(function($article) {
                    factory(App\Comment::class, 3)->create(['article_id' => $article->id]);
                });
            });
        });
    }
}
