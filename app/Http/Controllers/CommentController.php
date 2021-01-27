<?php

namespace App\Http\Controllers;

use App\Article;
use App\Comment;
use App\Http\Resources\Comment as CommentResource;
use App\Http\Resources\CommentCollection;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    private static $rules=[
        'text' => 'required',
    ];
    private static $message=[
        'required' => 'El campo :attribute es obligatorio'
    ];

    public function index(Article $article)
    {
        return response()->json(new CommentCollection($article->comments),200);
    }
    public function show(Article $article, Comment $comment)
    {
        $comment= $article->comments()->where('id', $comment->id)->firstOrFail();
        return new CommentResource ($comment);
    }
    public function store(Request $request, Article $article){
        $request->validate(self::$rules, self::$message);
        $comment=$article->comments()->save(new Comment($request->all()));
        return response()->json($comment, 201);
    }
    public function update(Request $request, Article $article){
        //
    }
    public function delete(Comment $comment){
        //
    }
}
