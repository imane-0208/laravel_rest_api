<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Http\Requests\ArticleRequest;
use App\Http\Resources\ArticleCollection;
use App\Http\Resources\ArticleResource;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::with('user')->paginate(10);
        return new ArticleCollection($articles);
    //  return Article::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ArticleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        $article = Article::create($request->all());
        if ($article) {
            return response()->json(['data' => new ArticleResource($article) ,'status' => 'success', 'message' => 'Article created successfully.'],200);
        } else {
            return response()->json(['data' => [] ,'status' => 'error', 'message' => 'Article could not be created.'],405);
        }
        // return response()->json($article, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ArticleRequest  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, Article $article)
    {
        $article->update($request->all());
        if ($article) {
            return response()->json(['data' => new ArticleResource($article) ,'status' => 'success', 'message' => 'Article updated successfully.'],200);
        } else {
            return response()->json(['data' => [],'status' => 'error', 'message' => 'Article could not be updated.'],405);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();
        if ($article) {
            return response()->json(['data' => [] ,'status' => 'success', 'message' => 'Article deleted successfully.'],200);
        } else {
            return response()->json(['data' => [],'status' => 'error', 'message' => 'Article could not be deleted.'],405);
        }
    }
}
