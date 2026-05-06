<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $articles = \App\Models\Article::with('user', 'tags', 'comments')->where('status', 'published')->latest()->take(5)->get();
        return view('home.index', compact('articles'));
    }
}
