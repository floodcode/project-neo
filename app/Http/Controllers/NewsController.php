<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\News;

class NewsController extends Controller
{
    public function index()
    {
        return view('news.index', [
            'news' => News::orderBy('created_at', 'desc')->paginate(15)
        ]);
    }

    public function view($id)
    {
        return view('news.view', [
            'item' => News::findOrFail($id)
        ]);
    }

    public function create()
    {
        return view('news.create');
    }
}
