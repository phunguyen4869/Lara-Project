<?php

namespace App\Http\Controllers;

use App\Http\Services\Category\CategoryService;
use Illuminate\Http\Request;

class MainCategoryController extends Controller
{
    protected $category;

    public function __construct(CategoryService $category)
    {
        $this->category = $category;
    }

    public function index(Request $request, $id, $slug)
    {
        $category = $this->category->getById($id);

        if ($category->parent_id != 0) {
            $sortBy = $request->price;
            (isset($request->minPrice)) ? $minPrice = $request->minPrice : $minPrice = null;
            (isset($request->maxPrice)) ? $maxPrice = $request->maxPrice : $maxPrice = null;

            $products = $this->category->getProductByCategory($category, $sortBy, $minPrice, $maxPrice);

            return view('category', [
                'title' => $category->name,
                'category' => $category,
                'products' => $products,
            ]);
        } else {
            return redirect()->back();
        }
    }
}
