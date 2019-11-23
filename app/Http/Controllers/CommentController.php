<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Store a newly created comment in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
           'author' => ['required', 'max:255'],
           'content' => ['required']
        ]);
        
        $comment = new Comment();
        $comment->fill($request->all());
        $comment->save();
        
        return redirect()->route('articles.show', ['slug' => $comment->article->slug])->with('messages', [__('messages.comment_added')]);
    }
}
