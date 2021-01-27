<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Resources\Article as ArticleResource;
use App\Http\Resources\ArticleCollection;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Self_;

class ArticleController extends Controller
{
    private static $message=[
        'required' => 'El campo :attribute es obligatorio',
    ];

    public function index()
    {
        return new ArticleCollection(Article::paginate(20));
    }
    public function show(Article $article)
    {
        return response()->json(new ArticleResource ($article),200);
    }
    public function store(Request $request){
        $request->validate([
            'title' => 'required|string|unique:articles|max:255',
            'body' => 'required',
            'category_id'=>'required|exists:categories.id',
            'image' => 'required|image|dimensions:min_width=200,min_height=200'
        ],self::$message);
        $article = new Article($request->all());
        $path = $request->image->store('public/articles');
        $article->image = $path;
        $article->save();
        return response()->json(new ArticleResource($article), 201);
    }
    public function update(Request $request, Article $article){
        $request->validate([
            'title' => 'required|string|unique:articles,title,'.$article->id.'|max:255',
            'body' => 'required',
            'category_id'=>'required|exists:categories.id'
        ],self::$message);
        $article->update($request->all());
        return response()->json($article, 200);
    }
    public function delete(Article $article){
        $article->delete();
        return response()->json(null, 204);
    }
}
