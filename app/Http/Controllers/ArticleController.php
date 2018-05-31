<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Transformers\ArticleTransformer;
use Cyvelnet\Laravel5Fractal\Facades\Fractal;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::all();

        return Fractal::collection($articles, new ArticleTransformer());
//        return Fractal::includes("author")->collection($articles, new ArticleTransformer());
    }

    public function store(StoreArticleRequest $request)
    {
        $article = new Article();
        $article->author_id = 1;
//        $article->author_id = $request->user()->id;
        $article->title = $request->title;
        $article->slug = str_slug($request->title);
        $article->body = $request->body;
        $article->save();

        return Fractal::item($article, new ArticleTransformer());
//        return Fractal::include("author")->item($article, new ArticleTransformer());
    }

    public function show(string $id)
    {
        $article = Article::find($id);
        return Fractal::item($article, new ArticleTransformer());
//        return Fractal::includes("author")->item($article, new ArticleTransformer());
    }

    public function update(UpdateArticleRequest $request, string $id)
    {
        $article = Article::find($id);

        dump($request);
        die;
        $article->title = $request->input("title");
        $article->slug = ($request->input("title")) ? str_slug($request->input("title")) : $article->slug;
        $article->body = $request->input("body");

        $article->save();

        return Fractal::item($article, new ArticleTransformer());
//        return Fractal::include("author")->item($article, new ArticleTransformer());
    }

    public function destroy(string $id)
    {
        $article = Article::find($id);
        $article->delete();

        return response(null, 200);
    }

}
