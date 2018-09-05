<?php

namespace App\Http\Controllers;

use App\Core\Roles;
use App\Models\Comment;
use App\Models\NewsL10n;
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
            'create'
        ]]);
    }

    public function index()
    {
        $news = null;
        $user = Auth::user();
        if ($user && Auth::user()->hasRole(Roles::ROLE_MODERATOR)) {
            $news = News::orderBy('created_at', 'desc')->paginate(10);
        } else {
            $news = News::translated()->orderBy('created_at', 'desc')->paginate(10);
        }

        return view('news.index', [
            'news' => $news
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
            return view('news.create', [
                'item' => new News()
            ]);
        }

        $request->flash();
        $data = $this->validate($request, $this->newsRules(), $this->newsMessages());
        $data['user-id'] = Auth::user()->id;

        $item = new News();
        $this->prefillNewsPost($item, $data);

        $item->save();

        return redirect(route('news.view', [$item->id]));
    }

    public function edit(Request $request, $id)
    {
        $item = News::findOrFail($id);
        if (!$item->hasAccess(Auth::user())) {
            abort(403);
        }

        if ($request->method() !== 'POST') {
            return view('news.edit', [
                'item' => $item
            ]);
        }

        $request->flash();
        $data = $this->validate($request, $this->newsRules(), $this->newsMessages());
        $this->prefillNewsPost($item, $data);
        $item->save();

        return redirect(route('news.view', [$item->id]));
    }

    public function delete($id): JsonResponse
    {
        $item = News::findOrFail($id);
        if (!$item->hasAccess(Auth::user())) {
            return $this->jsonError(__('message.error.not-authorized'));
        }

        if ($item->image) {
            Storage::disk('public')->delete(self::IMAGES_PATH . $item->image);
        }

        $item->delete();
        return $this->jsonSuccess();
    }

    protected function newsRules(): array
    {
        return [
            'title' => 'required|max:255',
            'message' => 'required',
            'image' => 'image|mimes:jpeg,png'
        ];
    }

    protected function newsMessages(): array
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
            $item->l10n()->title = $data['title'];
        }

        if (array_key_exists('message', $data)) {
            $item->l10n()->message = $data['message'];
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

    public function commentCreate(Request $request, $id)
    {
        $newsItem = News::findOrFail($id);
        if (!$newsItem) {
            return $this->jsonError();
        }

        $data = $this->validate($request, $this->commentRules(), $this->commentMessages());

        $item = new Comment();
        $item->news_id = $id;
        $item->user_id = Auth::user()->id;
        $item->message = $data['message'];
        $item->save();

        return $this->jsonSuccess();
    }

    public function commentDelete(Request $request, $id)
    {
        $item = Comment::findOrFail($id);
        if (!$item->hasAccess(Auth::user())) {
            return $this->jsonError();
        }

        $item->delete();
        return $this->jsonSuccess();
    }

    protected function commentRules(): array
    {
        return [
            'message' => 'required'
        ];
    }

    protected function commentMessages(): array
    {
        return [
            'message.required' => __('message.validation.comment-message-required')
        ];
    }
}
