<?php

namespace App\Http\Controllers;

use App\Core\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\News;

class NewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:poster', ['only' => [
            'create', 'edit'
        ]]);
    }

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

    public function edit($id)
    {
        $item = News::findOrFail($id);
        if (!$item->canEdit(Auth::user())) {
            abort(403);
        }

        return view('news.edit', [
            'item' => News::findOrFail($id)
        ]);
    }
}
