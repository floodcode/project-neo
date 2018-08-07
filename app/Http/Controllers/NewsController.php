<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\News;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    const IMAGES_PATH = 'img/news/';

    public function __construct()
    {
        $this->middleware('role:poster', ['only' => [
            'create', 'edit', 'delete'
        ]]);
    }

    public function index()
    {
        return view('news.index', [
            'news' => News::orderBy('created_at', 'desc')->paginate(10)
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
        if ($request->method() !== 'POST') {
            return view('news.create');
        }

        $request->flash();
        $data = $this->validate($request, $this->getValidationRules(), $this->getValidationMessages());
        $data['user-id'] = Auth::user()->id;

        $item = new News();
        $this->prefillNewsPost($item, $data);
        $item->save();

        return redirect(route('news.view', [$item->id]));
    }

    public function edit(Request $request, $id)
    {
        $item = News::findOrFail($id);
        if (!$item->canEdit(Auth::user())) {
            abort(403);
        }

        if ($request->method() !== 'POST') {
            return view('news.edit', [
                'item' => $item
            ]);
        }

        $request->flash();
        $data = $this->validate($request, $this->getValidationRules(), $this->getValidationMessages());
        $this->prefillNewsPost($item, $data);
        $item->save();

        return redirect(route('news.view', [$item->id]));
    }

    public function delete($id): JsonResponse
    {
        $item = News::findOrFail($id);
        if (!$item->canEdit(Auth::user())) {
            return $this->jsonError(__('message.error.not-authorized'));
        }

        if ($item->image) {
            Storage::disk('public')->delete(self::IMAGES_PATH . $item->image);
        }

        $item->delete();
        return $this->jsonSuccess();
    }

    protected function getValidationRules(): array
    {
        return [
            'title' => 'required|max:255',
            'message' => 'required',
            'image' => 'image|mimes:jpeg,png'
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

    protected function prefillNewsPost(News &$item, array $data)
    {
        if (array_key_exists('title', $data)) {
            $item->title = $data['title'];
        }

        if (array_key_exists('message', $data)) {
            $item->message = $data['message'];
        }

        if (array_key_exists('image', $data)) {
            if ($item->image) {
                Storage::disk('public')->delete(self::IMAGES_PATH . $item->image);
            }

            $item->image = basename($data['image']->store(self::IMAGES_PATH, 'public'));
        }

        if (array_key_exists('user-id', $data)) {
            $item->user_id = $data['user-id'];
        }
    }
}
