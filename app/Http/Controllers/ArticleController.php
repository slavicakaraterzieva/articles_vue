<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Http\Resources\Article as ArticleResource;
class ArticleController extends Controller
{
    public function index()
    {
        //get articles
        $articles=Article::orderBy('created_at', 'desc')->paginate(3);
        //return collection of articles as resource
        return ArticleResource::collection($articles);
        //dd($articles);
    }

    public function store(Request $request)
    { 
         $article=$request->isMethod('put') ? Article::findOrFail($request->article_id) : new Article;
         
        $article->id = $request->input('article_id');
        $article->title = $request->input('title');
        $article->description = $request->input('description');
        if($article->save()){
            return new ArticleResource($article);
        }
    
    }

    public function show($id)
    {
        //get single article
        $article=Article::findOrFail($id);
        //return article as resource
        return new ArticleResource($article);
        //dd($article);
    }

    public function destroy($id)
    {
         //get single article
         $article=Article::findOrFail($id);
         //return article as resource
         if($article->delete()){
            return new ArticleResource($article);
           
         }
    }

}
