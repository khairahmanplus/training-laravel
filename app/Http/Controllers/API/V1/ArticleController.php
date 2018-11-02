<?php

namespace App\Http\Controllers\API\V1;

use App\Article;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::get()->map(function ($article) {
            return [
                'tajuk'             => $article->title  ?? '-',
                'isi_kandungan'     => $article->body   ?? '-',
            ];
        });

        return response()->json([
            'status'    => 'berjaya',
            'data'      => $articles
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = validator($request->all(), [
            'title'     => 'required',
            'body'      => 'required',
            'status'    => [
                'required',
                Rule::in(['draft', 'published'])
            ]
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $article = Article::create([
            'user_id'   => 1, // auth()->id()
            'title'     => $request->title,
            'slug'      => str_slug($request->title),
            'body'      => $request->body,
            'status'    => $request->status
        ]);

        return response()->json([
            'status'    => 'berjaya',
            'data'      => [
                'id'            => $article->id,
                'tajuk'         => $article->title,
                'isi_kandungan' => $article->body,
                'status'        => $article->status,
                'url'           => route('api.articles.show', $article->id)
            ]
        ], 201);
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

        return response()->json([
            'status'    => 'berjaya',
            'data'      => [
                'id'            => $article->id,
                'tajuk'         => $article->title,
                'isi_kandungan' => $article->body,
                'status'        => $article->status
            ]
        ]);
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
        $validator = validator($request->all(), [
            'title'     => 'required',
            'body'      => 'required',
            'status'    => [
                'required',
                Rule::in(['draft', 'published'])
            ]
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $article = Article::findOrFail($id);

        $article->update([
            'title'     => $request->title,
            'body'      => $request->body,
            'status'    => $request->status
        ]);

        return response()->json([
            'status'    => 'berjaya',
            'data'      => [
                'id'            => $article->id,
                'tajuk'         => $article->title,
                'isi_kandungan' => $article->body,
                'status'        => $article->status,
                'url'           => route('api.articles.show', $article->id)
            ]
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Article::destroy($id);

        return response()->json([
            'status'    => 'berjaya',
        ], 204);
    }
}
