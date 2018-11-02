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
                'tajuk'             => $article->title ?? '-',
                'isi_kandungan'     => $article->body ?? '-',
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
            'user_id'   => 1,
            'title'     => $request->title,
            'body'      => $request->body,
            'status'    => $request->status
        ]);

        return response()->json([
            'status'    =>'berjaya',
            'data'      => $article
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
        //
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
        //
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
