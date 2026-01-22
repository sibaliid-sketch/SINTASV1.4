<?php

namespace App\Http\Controllers;

use App\Models\Welcomeguest\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::published()->orderBy('published_at', 'desc');

        $type = $request->get('type', 'all');
        if ($type !== 'all') {
            $query->where('type', $type);
        }

        $articles = $query->paginate(12);

        return view('welcome.welcomeguest.articles', compact('articles'));
    }

    public function show($slug)
    {
        $article = Article::published()->where('slug', $slug)->firstOrFail();

        return view('welcome.welcomeguest.article-detail', compact('article'));
    }
}
