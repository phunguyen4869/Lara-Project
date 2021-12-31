<?php

namespace App\View\Composers;

use App\Models\Category;
use Illuminate\View\View;

class CategoryComposer
{
    public function __construct()
    {
    }

    public function compose(View $view)
    {
        $categories = Category::select('id', 'name', 'parent_id', 'thumb', 'slug')->where('active', 1)->orderBy('id', 'asc')->get();

        $view->with('categories', $categories);
    }
}
