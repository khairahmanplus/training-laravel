<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // select * from articles
        $articles = Article::get();

        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:5|max:150|string|unique:articles,title',
            'body'  => 'required|min:5|max:10000'
        ]);

        // Cara Pertama
        $article            = new Article;
        $article->user_id   = $request->user()->id;
        $article->title     = $request->title;
        $article->slug      = str_slug($request->title);
        $article->body      = $request->body;
        $article->status    = $request->has('draft') ? 'draft' : 'published';
        $article->saveOrFail();

        // Cara kedua
        // Article::create([
        //     'user_id'   => $request->user()->id,
        //     'title'     => $request->title,
        //     'body'      => $request->body,
        //     'status'    => $request->has('draft') ? 'draft' : 'published',
        // ]);

        session()->flash('flash.type', 'success');
        session()->flash('flash.message', 'Article succesfully saved.');

        return redirect()->route('articles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::findOrFail($id);

        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::findOrFail($id);

        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|min:5|max:150|string',
            'body'  => 'required|min:5|max:10000'
        ]);

        $article = Article::findOrFail($id);

        $article->update([
            'title'     => $request->title,
            'body'      => $request->body,
            'status'    => $request->has('draft') ? 'draft' : 'published'
        ]);

        session()->flash('flash.type', 'success');
        session()->flash('flash.message', 'Articles succesfully updated.');

        return redirect()->route('articles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
