<?php

namespace App\Http\Controllers\Base;

use App\Models\Category;

class MainController extends Controller
{
    protected function renderData(): array
    {
        $categories = Category::all();

        return [
            'envCategories' => $categories
        ];
    }
}
