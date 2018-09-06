<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index()
    {
        return view('admin.index');
    }

    public function newsCategories()
    {
        return view('admin.news.categories', [
            'categories' => Category::all()
        ]);
    }

    public function newsCategoriesCreate(Request $request)
    {
        $data = $this->validate($request, $this->categoriesRules());

        $category = new Category();
        $category->slug = $data['slug'];
        $category->l10n()->name = $data['name'];
        $category->save();

        return $this->jsonSuccess();
    }

    public function newsCategoriesEdit(Request $request, $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return $this->jsonError();
        }

        $data = $this->validate($request, $this->categoriesRules());

        $category->slug = $data['slug'];
        $category->l10n()->name = $data['name'];
        $category->save();

        return $this->jsonSuccess();
    }

    public function newsCategoriesDelete($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return $this->jsonError();
        }

        $category->delete();
        return $this->jsonSuccess();
    }

    protected function categoriesRules(): array
    {
        return [
            'slug' => 'required|max:255',
            'name' => 'required|max:255'
        ];
    }
}
