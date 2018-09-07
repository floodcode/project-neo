<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\MainController;
use App\Core\Roles;
use App\Models\Category;
use App\Models\Comment;
use App\Models\NewsL10n;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\News;
use Illuminate\Support\Facades\Storage;

class NewsController extends MainController
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
        if (Auth::user() && Auth::user()->hasRole(Roles::ROLE_MODERATOR)) {
            $news = News::orderBy('created_at', 'desc')->paginate(10);
        } else {
            $news = News::translated()->orderBy('created_at', 'desc')->paginate(10);
        }

        return $this->render('news.index', [
            'news' => $news,
            'category' => null
        ]);
    }

    public function category(string $slug)
    {
        $category = Category::where('slug', $slug)->first();
        if (!$category) {
            abort(404);
        }

        $news = null;
        if (Auth::user() && Auth::user()->hasRole(Roles::ROLE_MODERATOR)) {
            $news = News::byCategory($category->id)->orderBy('created_at', 'desc')->paginate(10);
        } else {
            $news = News::byCategory($category->id)->translated()->orderBy('created_at', 'desc')->paginate(10);
        }

        return $this->render('news.index', [
            'news' => $news,
            'category' => $category
        ]);
    }

    public function view($id)
    {
        return $this->render('news.view', [
            'item' => News::findOrFail($id)
        ]);
    }

    public function create(Request $request)
    {
        if ($request->method() !== 'POST') {
            return $this->render('news.create', [
                'item' => new News(),
                'categories' => Category::all()
            ]);
        }

        $request->flash();
        $data = $this->validate($request, $this->newsCreateRules(), $this->newsMessages());
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
            return $this->render('news.edit', [
                'item' => $item,
                'categories' => Category::all()
            ]);
        }

        $request->flash();
        $data = $this->validate($request, $this->newsEditRules(), $this->newsMessages());
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

    public function deleteTranslation($id): JsonResponse
    {
        $item = News::findOrFail($id);
        if (!$item->hasAccess(Auth::user())) {
            return $this->jsonError(__('message.error.not-authorized'));
        }

        if ($item->isTranslated() && count($item->translations) <= 1) {
            return $this->jsonError(__('message.error.delete-only-translation'));
        }

        $item->l10n()->delete();
        return $this->jsonSuccess();
    }

    protected function newsCreateRules(): array
    {
        return [
            'title' => 'required|max:255',
            'message' => 'required',
            'image' => 'required|image|mimes:jpeg,png',
            'category-id' => 'required'
        ];
    }

    protected function newsEditRules(): array
    {
        return [
            'title' => 'required|max:255',
            'message' => 'required',
            'image' => 'image|mimes:jpeg,png',
            'category-id' => 'required'
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

        if (array_key_exists('category-id', $data)) {
            $categoryId = $data['category-id'];
            if ($categoryId == Category::NO_CATEGORY) {
                $item->category_id = null;
            } else {
                $item->category_id = $data['category-id'];
            }
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
