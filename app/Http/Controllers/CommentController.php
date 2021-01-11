<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Resources\Comment as CommentResource;
use App\Http\Resources\CommentCollection;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        return new CommentCollection(Comment::paginate());
    }
    public function show(Comment $comment)
    {
        return new CommentResource ($comment);
    }
    public function store(Request $request){
        $comment = Comment::create($request->all());
        return response()->json($comment, 201);
    }
    public function update(Request $request, Comment $comment){
        $comment->update($request->all());
        return response()->json($comment, 200);
    }
    public function delete(Comment $comment){
        $comment->delete();
        return response()->json(null, 204);
    }
}
