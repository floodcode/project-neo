<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\News;

class NewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:poster', ['only' => [
            'create', 'edit', 'delete'
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

    public function create(Request $request)
    {
        if ($request->method() === 'POST') {
            $this->validate($request, $this->getValidationRules(), $this->getValidationMessages());

            $item = new News();
            $item->title = $request->post('title', '');
            $item->message = $request->post('message', '');
            $item->user_id = Auth::user()->id;
            $item->save();

            return redirect(route('news.view', [$item->id]));
        }

        return view('news.create');
    }

    public function edit(Request $request, $id)
    {
        $item = News::findOrFail($id);
        if (!$item->canEdit(Auth::user())) {
            abort(403);
        }

        if ($request->method() === 'POST') {
            $data = $this->validate($request, $this->getValidationRules(), $this->getValidationMessages());

            $item->title = $data['title'];
            $item->message = $data['message'];
            $item->save();

            return redirect(route('news.view', [$item->id]));
        }

        return view('news.edit', [
            'item' => $item
        ]);
    }

    public function delete($id): JsonResponse
    {
        $item = News::findOrFail($id);
        if (!$item->canEdit(Auth::user())) {
            return $this->jsonError(__('message.error.not-authorized'));
        }

        $item->delete();
        return $this->jsonSuccess();
    }

    protected function getValidationRules(): array
    {
        return [
            'title' => 'required|max:255',
            'message' => 'required'
        ];
    }

    protected function getValidationMessages(): array
    {
        return [
            'title.required' => __('message.validation.news-title-required'),
            'title.max' => __('message.validation.news-title-max'),
            'message.required' => __('message.validation.news-message-required')
        ];
    }
}
