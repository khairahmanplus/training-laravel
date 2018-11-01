<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Article;

class PublicController extends Controller
{
    public function welcome()
    {
        // select * from articles where status = published OR where
        $articles = Article::where('status', 'published')->paginate();

        return view('welcome', compact('articles'));
    }

    public function showArticle()
    {

    }
}
