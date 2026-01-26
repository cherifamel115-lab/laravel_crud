<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    



public function index()
{
    $articles = Article::all();
    
    return view('articles.index', compact('articles'));
}

public function store(Request $request)
{
    $request->validate([
        'titre' => 'required|string',
        'categorie' => 'required|string',
        'content' => 'required|string',
        'prix' =>'required|int',
    ]);

    Article::create([
        'titre' => $request->titre,
        'categorie' => $request->categorie,
        'content' => $request->content,
        'prix' =>$request->prix
        ]);

    return redirect()->back();
}

public function destroy($id)
{
    Article::find($id)->delete();
    return redirect()->back();
}


public function update(Request $request)
{
    Article::where('titre',$request->titre)->update([
                'categorie' => $request->categorie,
                'content' => $request->content,
                'prix' =>$request->prix
            ]);
    return redirect()->back();
}

}