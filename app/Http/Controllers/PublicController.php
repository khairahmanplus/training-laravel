<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Article;

class PublicController extends Controller
{
    public function welcome()
    {
        // select * from articles where status = published
        $articles = Article::with('user')->where('status', 'published')->paginate();

        return view('welcome', compact('articles'));
    }

    public function showArticle($username, $slug)
    {
        // select * from articles where slug = $slug limit 1
        $article = Article::where('slug', $slug)->firstOrFail();

        return view('show_article', compact('article'));
    }
}
